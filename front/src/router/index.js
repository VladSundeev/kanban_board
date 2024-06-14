import { createRouter, createWebHistory } from 'vue-router';
import TaskBoard from '../components/ColumnList.vue';
import AddColumn from '../components/AddColumn.vue';
import AddTask from '../components/AddTask.vue';
import UserLogin from '../components/UserLogin.vue';
import UserRegister from '../components/UserRegister.vue';

const routes = [
    {
        path: '/',
        name: 'TaskBoard',
        component: TaskBoard,
        // meta: { requiresAuth: true }
    },
    {
        path: '/add-column',
        name: 'AddColumn',
        component: AddColumn,
        meta: { requiresAuth: true }
    },
    {
        path: '/add-task',
        name: 'AddTask',
        component: AddTask,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: 'UserLogin',
        component: UserLogin
    },
    {
        path: '/register',
        name: 'UserRegister',
        component: UserRegister
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('token');

    if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
        next('/login');
    } else {
        next();
    }
});

export default router;
