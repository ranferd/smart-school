<template>
  <CContainer class="d-flex content-center min-vh-100">
    <CRow>
      <CCol>
        <CCardGroup>
          <CCard class="p-6">
            <CCardBody>
              <CForm @submit.prevent="login" method="POST">
                <h1>Login as Teacher/Student</h1>
                <p class="text-muted">Sign In to your account</p>
                <CInput
                  v-model="school_id"
                  prependHtml="<i class='cui-user'></i>"
                  placeholder="School ID"
                  autocomplete="name"
                >
                  <template #prepend-content
                    ><CIcon name="cil-user"
                  /></template>
                </CInput>
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
                    <CButton @click="goAdminLogin()" color="link" class="px-0"
                      >Login As School Admin</CButton
                    >
                  </CCol>
                </CRow>
              </CForm>
            </CCardBody>
          </CCard>
        </CCardGroup>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      school_id: "",
      username: "",
      password: "",
      showMessage: false,
      message: "",
    };
  },
  methods: {
    goAdminLogin() {
      this.$router.push({ path: "admin-login" });
    },
    login() {
      let self = this;
      axios
        .post(this.$apiAdress + "/login", {
          school_id: self.school_id,
          username: self.username,
          password: self.password,
          is_admin: 0,
        })
        .then(function (response) {
          self.school_id = "";
          self.username = "";
          self.password = "";
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
