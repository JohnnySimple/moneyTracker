import Vue from 'vue'
import Router from 'vue-router'
import Homepage from '@/components/Homepage'
import Login from '@/components/Login'
import Register from '@/components/Register'
import Dashboard from '@/components/Dashboard'
import Logout from '@/components/Logout'
import NotFound from '@/components/NotFound'
import Profile from '@/components/Profile'
import Dash from '@/components/Dash'
import Category from '@/components/Category'
import Wallet from '@/components/Wallets'
import Expense from '@/components/Expense'
import Income from '@/components/Income'

Vue.use(Router)

let router = new Router({
  routes: [
    {
      path: '/',
      name: 'Homepage',
      component: Homepage
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        guest: true
      }
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        guest: true
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard,
      meta: {
        requiresAuth: true,
        // hideNavbar: true
      },
      children: [
        {
          path: 'dash',
          component: Dash,
          meta: {
            // hideNavbar: true
          }
        },
        {
          path: 'profile',
          // name: 'profile',
          component: Profile,
          meta: {
            // hideNavbar: true,
            dashComponent: true
          }
        },
        {
          path: 'categories',
          component: Category,
          meta: {
            // hideNavbar: true
          }
        },
        {
          path: 'wallets',
          component: Wallet,
          meta: {
            // hideNavbar: true
          }
        },
        {
          path: 'expense',
          component: Expense,
          meta: {
            // hideNavbar: true
          }
        },
        {
          path: 'income',
          component: Income,
          meta: {
            // hideNavbar: true
          }
        }
      ]
    },
    {
      path: '/logout',
      name: 'logout',
      component: Logout
    },
    {
      path: "*",
      component: NotFound
    }
  ]
})

// method to run before rendering each route
router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if(sessionStorage.getItem('token') == null) {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    } else {
      next()
    }
  } else if(to.matched.some(record => record.meta.guest)) {
    if(sessionStorage.getItem('token') == null) {
      next()
    }
    else {
      next({ name: 'dashboard' })
    }
  } else {
    next()
  }
})


export default router