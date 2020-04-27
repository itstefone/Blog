import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate'
Vue.use(Vuex);


export const store = new Vuex.Store({
  plugins: [createPersistedState({
    storage: window.sessionStorage,
})],
state: {
  status: '',
  token: '',
  user : {},
  categories : [],
  posts: []
},
getters: {
    isLoggedIn: state => !!state.token,
    authStatus: state => state.status,
    user: state => state.user,
    categories: state => state.categories,
    posts: state => state.posts
},
mutations: {
    logout: state => {
      state.status = '';
      state.token = '';
      state.user = '';
    },
    auth_request: state => {
      state.status = 'loading';
    },
    auth_success: (state, data) => {
      state.status = 'success';
      state.token = data.token;
      state.user = data.user;
    },
    auth_error: state => {
      state.status = 'error';
    },
    updateUser: (state, user) => {
      state.user = user;
    },
    updateCategories: (state, categories) => {
      state.categories = categories;
    },
    updatePostsState: (state, posts) => {
      state.posts = posts;
    }
},
actions: {

logout({commit}) {
  return new Promise((resolve)=> {
    commit('logout');

    window.axios.get('logout').then(response => {
      localStorage.removeItem('token');
      resolve(response);
    });
   
  });
},
login({commit}, user) {
   return new Promise((resolve, reject)=> {
    commit('auth_request');
    window.axios.post('auth/login', user)
    .then(response => {
      const token = response.data.access_token;
      const user = response.data.user;
      localStorage.setItem('token', token);
      commit('auth_success', {token,user});
      resolve(response);
    })
    .catch(err => {
        reject(err.response);
    });
   });
},
refresh({commit}) {
  const token = localStorage.getItem('token');
  if(token) {
    return new Promise((resolve, reject) => {
        commit('auth_request');
        window.axios.get('refresh')
        .then(response => {
            const user = response.data.user;
            commit('auth_success', {token,user} );
            resolve();
        })
        .catch(err => {
              reject(err.response);
          });

    });

  }
},
updateUser({commit}, user) {
  commit('updateUser', user);
},
getCategories({commit}) {
  return new Promise((resolve) => {
    window.axios.get('categories')
    .then((response) => {
      const categories = response.data.categories;
      commit('updateCategories', categories);
      resolve(response);
    })
  });
},
getPosts({commit}) {
  return new Promise((resolve) => {
        window.axios.get('posts').then(response => {
            const posts = response.data.posts;
              commit('updatePostsState', posts);
              resolve(response);
        });
  });
}
}

});