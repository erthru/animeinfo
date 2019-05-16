<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <router-link class="navbar-brand text-white" to="/">Anime info</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <router-link class="nav-link text-light" :to="'/'">
              Home
              <span class="sr-only">(current)</span>
            </router-link>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="/search">
          <input
            class="form-control mr-sm-2"
            type="search"
            name="q"
            placeholder="Search"
            aria-label="Search"
            :value="this.$route.query.q"
          >
          <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </div>
</template>
