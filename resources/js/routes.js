import Home from './components/Home'
import Profile from './components/Profile'
import Videos from './components/Videos'
import Fotos from './components/Fotos'
import Blogs from './components/Blogs'
import Stars from './components/Stars'
import Followers from './components/Followers'
import Jobs from './components/Jobs'
import Settings from './components/Settings'
import Create_blog from './components/Blogs/Create_blog'
import Blog from './components/Blog'

export default{

    mode: 'history',

    routes: [

        {
            path: '/',
            component: Home
        },

        {
            path: '/home',
            component: Home
        },

        {
            path: '/profile',
            component: Profile
        },

        {
            path: '/photos',
            component: Fotos
        },

        {
            path: '/videos',
            component: Videos
        },

        {
            path: '/blogs',
            component: Blogs
        },

        {
            path: '/create_blog',
            component: Create_blog
        },

        {
            path: '/stars',
            component: Stars
        },

        {
            path: '/followers',
            component: Followers
        },

        {
            path: '/jobs',
            component: Jobs
        },

        {
            path: '/settings',
            component: Settings
        },

        {
            path: '/blog/:id',
            component: Blog
        }

    ]

}
