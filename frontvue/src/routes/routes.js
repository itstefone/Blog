import BlogPost from '../components/BlogPosts.vue';
import RegisterForm from '../components/RegisterForm.vue';
import SearchForm from '../components/SearchForm.vue';
import LoginForm from '../components/LoginForm.vue';
import {store} from '../store/store';
import User from '../components/User.vue';
import UserProfile from '../components/UserProfile.vue';
import SettingProfile from '../components/SettingProfile.vue';
import CreateBlogPost from '../components/CreateBlogPost.vue';
export const routes = [
{


  path: '/', components:
  {
      default:BlogPost,
      searchForm:  SearchForm
  }, 
  name:'home'
},
{

  path: '/create', components: {
    default: CreateBlogPost
  },
  meta: {
    permission: 'User'
  },
  beforeEnter: auth,
  name: 'createBlogPost'
},
{
  path: '/register', components: {default: RegisterForm}, name:'register',
  meta: {
    permission: 'Unauthorized'
  },
  beforeEnter: auth
},
{
  path: '/login', components: {default: LoginForm}, name:'login',
  meta: {
      permission: 'Unauthorized'
  },
  beforeEnter: auth
  },
{
  path: '/user', components: {default: User},
 children: [
    {
      path:'profile',
      component: UserProfile,
      name: 'profile',
      meta: {
        permission: 'User'
      },
      beforeEnter: auth
    },
    {
      path:'setting',
      component: SettingProfile,
      name: 'profileSetting',
      meta: {
            permission: 'User'
      },
      beforeEnter: auth
    },

  ]
}
];



function auth(to,from,next) {
    if(to.meta.permission == 'Unauthorized') {
      if(store.getters.isLoggedIn) {
        next('/');
      } else {
        next();
      }
    } else if (to.meta.permission == 'User'){
      if(store.getters.isLoggedIn) {
        next();
      } else {
        next('/');
      }
    }
    else {
      next('/');
    }
  




  }