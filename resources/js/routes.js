import Home from './components/Home';
import Profile from './components/Profile';
import Videos from './components/Videos';
import Fotos from './components/Fotos';
import Blogs from './components/Blogs';

export default{

    mode: 'history',

    routes: [
        {
            path: '/',
            component: Home
        },

        {
            path: '/profile',
            component: Profile
        },

        {
            path: '/videos',
            component: Videos
        },

        {
            path: '/fotos',
            component: Fotos
        },

        {
            path: '/blogs',
            component: Blogs
        },


    ]

}
