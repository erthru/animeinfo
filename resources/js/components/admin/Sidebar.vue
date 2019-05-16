<template>
  <div class="bg-primary" style="padding: 16px 16px 16px 16px; overflow: hidden; margin-bottom: -5000px; padding-bottom: 5000px;">
    <h3 class="text-white" style="margin-top:20px; margin-left:14px">Anime Info</h3>
    <div class="col-lg-12" style="margin-top:26px">
      <img src="/assets/icn_home.png" style="margin-top:-6px" height="26" width="26">
      <router-link class="text-white" style="font-size:18px; margin-left:10px;" to="/">Home</router-link>
    </div>
    <div class="col-lg-12" style="margin-top:16px">
      <img src="/assets/icn_content.png" style="margin-top:-6px" height="26" width="26">
      <router-link
        class="text-white"
        style="font-size:18px; margin-left:10px;"
        to="/admin/content"
      >Content</router-link>
    </div>
    <div class="col-lg-12" style="margin-top:16px">
      <img src="/assets/icn_office.png" style="margin-top:-6px" height="26" width="26">
      <router-link
        class="text-white"
        style="font-size:18px; margin-left:10px;"
        to="/admin/studio"
      >Studio</router-link>
    </div>
    <div class="col-lg-12" style="margin-top:16px">
      <img src="/assets/icn_logout.png" style="margin-top:-6px" height="26" width="26">
      <router-link
        class="text-danger"
        style="font-size:18px; margin-left:10px;"
        to="/admin/logout"
      >Logout</router-link>
    </div>
  </div>
</template>