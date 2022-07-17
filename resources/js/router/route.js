import Home from "../pages/Home.vue";
import about from "../pages/About.vue";
import blog from "../pages/Blog.vue";
import contact from "../pages/Contact.vue";
const routes = [
    {
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/about",
        name: "about",
        component: about,
    },
    {
        path: "/blog",
        name: "blog",
        component: blog,
    },
    {
        path: "/contact",
        name: "contact",
        component: contact,
    },
];

export default routes;
