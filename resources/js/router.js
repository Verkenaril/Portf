import { createRouter, createWebHistory } from "vue-router";
import LoginView from "./views/LoginView.vue";
import SettingView from "./views/SettingView.vue";
import RegistrationView from "./views/RegistrationView.vue";
import PeoplesView from "./views/PeoplesView.vue";
import MainPageView from "./views/MainPageView.vue";
import FriendsView from "./views/FriendsView.vue";
import PersonPageView from "./views/PersonPageView.vue";
import ChatsView from "./views/ChatsView.vue";
import MessagesView from "./views/MessagesView.vue";
import GalleryView from "./views/GalleryView.vue";

import Test1 from "./views/Test1.vue";
import Test2 from "./views/Test2.vue";


const routes =
[
    {path: "/login", name:"login", component: LoginView},
    {path: "/registration", name:"registration", component: RegistrationView},
    {path: "/peoples", name:"peoples", component: PeoplesView},
    {path: "/setting", name:"setting", component: SettingView},
    {path: "/main", name:"main", component: MainPageView},
    {path: "/friends", name:"friends", component: FriendsView},
    {path: "/user/id:id", name:"person_page", component: PersonPageView},
    {path: "/chats/", name:"chats", component: ChatsView},
    {path: "/gallery/", name:"gallery", component: GalleryView},
    {path: "/chat/id:id", name:"chat_user", component: MessagesView},
    
    {path: "/test1", name:"test1", component: Test1},];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => 
{
    const token = localStorage["x_xsrf_token"];
    if(!token)
    {
        if(to.name === "login" || to.name === "registration") return null;
        else return {name: "login"};
    }
    if(to.name === "login" || to.name === "registration" && token) return {name:"peoples"};
});

export default router;