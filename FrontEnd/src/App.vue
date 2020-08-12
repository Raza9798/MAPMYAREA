<template>
  <v-app>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">MAP MY-AREA</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <v-spacer></v-spacer>
        <ul class="navbar-nav">
          <li class="nav-item">
            <!-- NAVIGATION BUTTON -->
            <v-btn class="ma-2 NBTN" to="/" tile color="dark" dark>HOME</v-btn>
            <!-- <v-btn class="ma-2 NBTN" to="/travel" tile color="dark" dark
              >TRAVEL
            </v-btn>
            <v-btn class="ma-2 NBTN" to="/creg" tile color="dark" dark
              >CLIENT REGISTER
            </v-btn> -->
          </li>
        </ul>
      </div>
    </nav>

    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: "App",
  components: {},

  data: () => ({
    //
  }),
};
</script>
<style scoped>
.NBTN {
  text-decoration: none;
}
</style>
