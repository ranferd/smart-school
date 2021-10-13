import Vue from 'vue'
import Router from 'vue-router'

// Containers
const TheContainer = () => import('@/containers/TheContainer')

// Views
const Dashboard = () => import('@/views/Dashboard')

// Views - Pages
const Page404 = () => import('@/views/pages/Page404')
const Page500 = () => import('@/views/pages/Page500')
const Login = () => import('@/views/pages/Login')
const AdminLogin = () => import('@/views/pages/AdminLogin')
const Register = () => import('@/views/pages/Register')

// Users
const Users = () => import('@/views/users/Users')
const Invite = () => import('@/views/users/Invite')

const Teachers = () => import('@/views/teachers/Teachers')

const Students = () => import('@/views/students/Students')


Vue.use(Router)

let router = new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})


router.beforeEach((to, from, next) => {
  let roles = localStorage.getItem("roles");

  if (to.matched.some(record => record.meta.requiresSchoolAdmin)) {
    if (roles != null && roles == 'school-admin') {
      next()
    } else {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    }
  } else if (to.matched.some(record => record.meta.requiresTeacher)) {
    if (roles != null && roles == 'teacher') {
      next()
    } else {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    }
  } else if (to.matched.some(record => record.meta.requiresStudent)) {
    if (roles != null && roles == 'student') {
      next()
    } else {
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    }
  } else {
    next()
  }
})

export default router

function configRoutes() {
  return [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: TheContainer,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'users',
          redirect: '/users/index',
          meta: { label: 'Users' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: 'index',
              meta: {
                label: 'List',
                requiresSchoolAdmin: true
              },
              name: 'List',
              component: Users,
            },
            {
              path: 'invite',
              meta: {
                label: 'Invite Teacher/Student',
                requiresSchoolAdmin: true
              },
              name: 'Invite Teacher/Student',
              component: Invite,
            },
          ]
        },
        {
          path: 'teachers',
          meta: { label: 'Teachers & Students' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: '',
              meta: {
                label: 'Teachers',
                requiresTeacher: true
              },
              name: 'Teachers',
              component: Teachers,

            },
          ]
        },
        {
          path: 'students',
          meta: { label: 'Students' },
          component: {
            render(c) { return c('router-view') }
          },
          children: [
            {
              path: '',
              meta: {
                label: 'Students',
                requiresStudent: true
              },
              name: 'Students',
              component: Students,

            },
          ]
        },
      ]
    },
    {
      path: '/pages',
      redirect: '/pages/404',
      name: 'Pages',
      component: {
        render(c) { return c('router-view') }
      },
      children: [
        {
          path: '404',
          name: 'Page404',
          component: Page404
        },
        {
          path: '500',
          name: 'Page500',
          component: Page500
        },
      ]
    },
    {
      path: '/',
      redirect: '/login',
      name: 'Auth',
      component: {
        render(c) { return c('router-view') }
      },
      children: [
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'admin-login',
          name: 'AdminLogin',
          component: AdminLogin
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        },
      ]
    },
    {
      path: '*',
      name: '404',
      component: Page404
    }
  ]
}
