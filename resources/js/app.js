require('./bootstrap');
require("datatables.net");
require("datatables.net-bs4");

window.Vue = require('vue');


import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';
import App from './components/App.vue';

Vue.use(VueRouter, VueAxios, Axios);

// content routes
import ContentIndex from './components/content/Index.vue';
import ContentSearch from './components/content/Search.vue';
import ContentRead from './components/content/Read.vue';
import ContentByStudio from './components/content/ByStudio.vue';

// admin routes
import AdminLogin from './components/admin/Login.vue';
import AdminContent from './components/admin/Content.vue';
import AdminLogout from './components/admin/Logout.vue';
import AdminContentAdd from './components/admin/ContentAdd.vue';
import AdminContentRead from './components/admin/ContentRead.vue';
import AdminStudio from './components/admin/Studio.vue';
import AdminStudioAdd from './components/admin/StudioAdd.vue';
import AdminStudioDetail from './components/admin/StudioDetail.vue';

const routes = [
    {
        name: 'content index',
        path: '/',
        component: ContentIndex
    },
    {
        name: 'content read',
        path: '/read/:id',
        component: ContentRead
    },
    {
        name: 'admin login',
        path: '/admin/login',
        component: AdminLogin
    },
    {
        name: 'admin content',
        path: '/admin/content',
        component: AdminContent
    },
    {
        name: 'admin logout',
        path: '/admin/logout',
        component: AdminLogout
    },
    {
        name: 'content search',
        path: '/search',
        component: ContentSearch
    },
    {
        name: 'admin content add',
        path: '/admin/content/add',
        component: AdminContentAdd
    },
    {
        name: 'admin content read',
        path: '/admin/content/read/:id',
        component: AdminContentRead
    },
    {
        name: 'content by studio',
        path: '/content/studio/:id',
        component: ContentByStudio
    },
    {
        name: 'admin studio',
        path: '/admin/studio/',
        component: AdminStudio
    },
    {
        name: 'admin studio add',
        path: '/admin/studio/add',
        component: AdminStudioAdd
    },
    {
        name: 'admin studio detail',
        path: '/admin/studio/detail/:id',
        component: AdminStudioDetail
    }
];

// base api
Vue.prototype.animeapi = 'http://localhost:8000/api/';

const router = new VueRouter({ mode: 'history', routes: routes });
new Vue(Vue.util.extend({ router }, App)).$mount("#app");
