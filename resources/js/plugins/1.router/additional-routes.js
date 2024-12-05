// 👉 Redirects
export const redirects = [
  // ℹ️ We are redirecting to different pages based on role.
  // NOTE: Role is just for UI purposes. ACL is based on abilities.
  {
    path: '/',
    name: 'index',
    redirect: to => {
      // TODO: Get type from backend
      const userData = useCookie('userData')
      const userRole = userData.value?.role
      if (userRole === 'admin')
        return { name: 'index' } // replace with admin dashboard
      if (userRole === 'client')
        return { name: 'index' } // replace with client dashboard

      return { name: 'login', query: to.query }
    },
  },
  {
    path: '/dashboard',
    name: 'index',
    redirect: to => {
      //  TODO: Get type from backend
      const userData = useCookie('userData')
      const userRole = userData.value?.role
      if (userRole === 'admin')
        return { name: 'index' } // replace with admin dashboard
      if (userRole === 'client')
        return { name: 'index' } // replace with client dashboard

      return { name: 'login', query: to.query }
    },
  },
  {
    path: '/pages/company',
    redirect: { name: 'pages-company-index' },
  },
  {
    path: '/pages/company/create',
    redirect: { name: 'company-create' },
    meta: {
      navActiveLink: 'pages-company',
    },
  },
  {
    path: '/login',
    name: 'login',
    redirect: () => ({ name: 'login', params: { tab: 'login' } }),
  },
  {
    path: '/pages/user-profile',
    name: 'pages-user-profile',
    redirect: () => ({ name: 'pages-user-profile-tab', params: { tab: 'profile' } }),
  },
  {
    path: '/pages/account-settings',
    name: 'pages-account-settings',
    redirect: () => ({ name: 'pages-account-settings-tab', params: { tab: 'account' } }),
  },
]

export const routes = [

]
