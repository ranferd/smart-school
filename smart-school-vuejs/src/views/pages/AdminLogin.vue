<template>
  <CContainer class="d-flex content-center min-vh-100">
    <CRow>
      <CCol>
        <CCardGroup>
          <CCard class="mx-4 mb-0">
            <CCardBody>
              <CForm @submit.prevent="login" method="POST">
                <h1>Login as School Admin</h1>
                <p class="text-muted">Sign In to your account</p>
                <CInput
                  v-model="username"
                  prependHtml="<i class='cui-user'></i>"
                  placeholder="Username"
                  autocomplete="username"
                >
                  <template #prepend-content
                    ><CIcon name="cil-user"
                  /></template>
                </CInput>
                <CInput
                  v-model="password"
                  prependHtml="<i class='cui-lock-locked'></i>"
                  placeholder="Password"
                  type="password"
                  autocomplete="curent-password"
                >
                  <template #prepend-content
                    ><CIcon name="cil-lock-locked"
                  /></template>
                </CInput>
                <CRow>
                  <CCol col="6">
                    <CButton type="submit" color="primary" class="px-4"
                      >Login</CButton
                    >
                  </CCol>
                  <CCol col="6" class="text-right">
                    <CButton @click="goLogin()" color="link" class="px-0"
                      >Login As Teacher/Student</CButton
                    >
                  </CCol>
                </CRow>
              </CForm>
            </CCardBody>
          </CCard>
          <CCard
            color="primary"
            text-color="white"
            class="text-center py-5"
            body-wrapper
          >
            <h2>Sign up</h2>
            <p>Sign up your school at Smart School right now!.</p>
            <CButton color="primary" class="active mt-3" @click="goRegister()">
              Sign Up Now!
            </CButton>
          </CCard>
        </CCardGroup>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script>
import axios from "axios";

export default {
  name: "AdminLogin",
  data() {
    return {
      username: "",
      password: "",
      showMessage: false,
      message: "",
    };
  },
  methods: {
    goRegister() {
      this.$router.push({ path: "register" });
    },
    goLogin() {
      this.$router.push({ path: "login" });
    },
    login() {
      let self = this;
      axios
        .post(this.$apiAdress + "/login", {
          username: self.username,
          password: self.password,
          is_admin: 1,
        })
        .then(function (response) {
          self.username = "";
          self.password = "";
          console.log(response);
          localStorage.setItem("api_token", response.data.data.token);
          localStorage.setItem("roles", response.data.data.user.role);
          self.$router.push({ path: "dashboard" });
        })
        .catch(function (error) {
          alert("Incorrect Username or password");
          console.log(error);
        });
    },
  },
};
</script>
