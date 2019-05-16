<template>
  <div>
    <div class="row">
      <div class="col-md-6 mx-auto">
        <br>
        <br>
        <br>
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-4">Login</h1>
            <form @submit.prevent="auth()">
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input
                  type="email"
                  class="form-control"
                  id="txEmail"
                  aria-describedby="emailHelp"
                  placeholder="Enter email"
                >
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="txPassword" placeholder="Password">
              </div>
              <button type="submit" id="btnSubmit" class="btn btn-primary">Login</button>
            </form>
            <div class="alert alert-danger" id="alertFail" role="alert" hidden>Login failed.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
      if(localStorage.getItem("id") != null){
          this.$router.push("/admin/content");
      }
  },
  methods: {
    auth() {
      $("#alertFail").attr("hidden", "");
      $("#btnSubmit")
        .attr("disabled", "")
        .text("Processing...");
      axios
        .post(this.animeapi+"admins/login", {
          email: $("#txEmail").val(),
          password: $("#txPassword").val()
        })
        .then(response => {
          if (response.data.msg == "SUCCESS") {
            localStorage.setItem("id",response.data.result.id);
            this.$router.push('/admin/content');
          } else {
            $("#alertFail").removeAttr("hidden");
            $("#btnSubmit")
              .removeAttr("disabled")
              .text("Login");
          }
        });
    }
  }
};
</script>
