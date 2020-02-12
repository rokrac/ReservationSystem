import Vue from 'vue'
import Router from 'vue-router'
import Home from './components/HomeComponent.vue'
import Reservations from './components/ReservationsComponent.vue'

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/reservations',
            name: 'reservations',
            component: Reservations
        }
    ]
})
