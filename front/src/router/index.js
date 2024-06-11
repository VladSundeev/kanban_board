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
        meta: { requiresAuth: true } // Объявляем метаданные, требующие аутентификации
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

// Навигационный охранник для аутентификации
router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user');

    // Если маршрут требует аутентификации и пользователь не аутентифицирован, перенаправляем на страницу входа
    if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
        next('/login');
    } else {
        next();
    }
});

export default router;
