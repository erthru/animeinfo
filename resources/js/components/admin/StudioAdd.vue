<template>
  <div>
    <div class="row">
      <div class="col-md-3">
        <sidebar></sidebar>
      </div>
      <div class="col-md-9">
        <br>
        <h3>Add Studio</h3>
        <div class="row">
          <div class="col-md-6">
            <form @submit.prevent="addStudio()">
              <div id="form-group">
                <label>Studio Name</label>
                <input type="textfield" class="form-control" id="txName" placeholder="Studio Name">
              </div>
              <br>
              <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AdminSidebar from "./Sidebar.vue";
export default {
  components: {
    sidebar: AdminSidebar
  },
  methods: {
    addStudio() {
        $("#btnSubmit").attr("disabled","").text("Processing...");
        axios.post(this.animeapi+"studios/",{
            name: $("#txName").val()
        }).then(response=>{
            this.$router.push("/admin/studio");
        });
    }
  }
};
</script>