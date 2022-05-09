import { createRouter, createWebHistory } from "vue-router";
import Inicio from "../views/InicioView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "inicio",
      component: Inicio,

    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/RegisterView.vue"),

    },
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginView.vue"),
    },
    {
      path: "/perfil",
      name: "perfil",
      component: () => import("../views/PerfilView.vue"),
    },
  ],
});

export default router;
