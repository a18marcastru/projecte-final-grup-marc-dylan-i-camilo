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
      path: "/tienda",
      name: "tienda",
      component: () => import("../views/TiendaView.vue"),

    },
    {
      path: "/reserva",
      name: "reserva",
      component: () => import("../views/ReservaView.vue"),

    },

    {
      path: "/perfil/:id",
      name: "perfil",
      component: () => import("../views/PerfilView.vue"),
    },
  ],
});

export default router;
