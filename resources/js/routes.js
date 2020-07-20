import Home from './views/Home'
import Profile from './views/Profile' /* remember resolve this one  */
import Videos from './views/Videos'
import Fotos from './views/Fotos'
import Blogs from './views/Blogs'
import Create_blog from './views/Create_blog'
import Blog from './views/Blog'
import Edit_profile from './views/Edit_profile'
import Results from './views/Results'
import Chat from './views/Chat'
import Notifications from './views/Notifications'
import User from './views/User'
import NotFound from './views/NotFound'

import Prueba from './views/Prueba'
import NavBar from './components/NavBar'
import Bottom_navbar from './components/bottom_navbar'

export default{

    mode: 'history',

    routes: [

        { path: '/',  component: Home },

        { path: '/venlop', component: NotFound },

        { path: '*', redirect: '/venlop' },

        { path: '/prueba', component: Prueba },

        { path: '/bottom_navbar', component: Bottom_navbar },

        { path: '/navbar', omponent: NavBar },

        { path: '/home', component: Home },

        { path: '/user', component: User },

        { path: '/photos', component: Fotos },

        { path: '/videos', component: Videos },

        { path: '/blogs', component: Blogs },

        { path: '/create_blog', component: Create_blog },

        { path: '/blog', component: Blog },

        { path: '/edit_profile', component: Edit_profile },

        { path: '/results', component: Results },

        { path: '/chat', component: Chat },

        { path: '/notifications', component: Notifications }

    ]

}
