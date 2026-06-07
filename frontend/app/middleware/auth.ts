export default defineNuxtRouteMiddleware((to, from) => {
  // Verificar se está no lado do cliente
  if (process.client) {
    const student = localStorage.getItem("student");

    if (!student) {
      return navigateTo("/login");
    }
  }
});
