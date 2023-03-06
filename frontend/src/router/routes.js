
const routes = [
  {
    path: '/',
    name: 'Disconnected',
    component: () => import('layouts/Disconnected'),
    children: [
      { path: '', component: () => import('pages/Accueil.vue'), name: 'AccueilDisconnected' }
    ]
  },
  {
    path: '/connected',
    name: 'Connected',
    component: () => import('layouts/Connected'),
    children: [
      { path: '', component: () => import('pages/Accueil.vue'), name: 'AccueilConnected' }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
