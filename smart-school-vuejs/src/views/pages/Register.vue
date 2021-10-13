<template>
  <div class="d-flex align-items-center min-vh-100">
    <CContainer fluid>
      <CRow class="justify-content-center">
        <CCol md="6">
          <CCard class="mx-4 mb-0">
            <CCardBody class="p-4">
              <CForm @submit.prevent="signUp" method="POST">
                <h1>Sign Up</h1>
                <p class="text-muted">Create your account</p>
                <CInput
                  placeholder="School Name"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="name"
                  v-model="school_name"
                >
                  <template #prepend-content
                    ><CIcon name="cil-user"
                  /></template>
                </CInput>
                <CInput
                  placeholder="Name"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="name"
                  v-model="name"
                >
                  <template #prepend-content
                    ><CIcon name="cil-user"
                  /></template>
                </CInput>
                <CInput
                  placeholder="Email"
                  prepend="@"
                  autocomplete="email"
                  v-model="email"
                />
                <CInput
                  placeholder="Password"
                  type="password"
                  prependHtml="<i class='cui-lock-locked'></i>"
                  autocomplete="new-password"
                  v-model="password"
                >
                  <template #prepend-content
                    ><CIcon name="cil-lock-locked"
                  /></template>
                </CInput>
                <CInput
                  placeholder="Repeat password"
                  type="password"
                  prependHtml="<i class='cui-lock-locked'></i>"
                  autocomplete="new-password"
                  class="mb-4"
                  v-model="password_confirmation"
                >
                  <template #prepend-content
                    ><CIcon name="cil-lock-locked"
                  /></template>
                </CInput>
                <CButton type="submit" color="success" block
                  >Create Account</CButton
                >
              </CForm>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

  <script>
import axios from "axios";
export default {
  data() {
    return {
      school_name: "",
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    };
  },
  methods: {
    signUp() {
      var self = this;
      if (
        self.name == "" ||
        self.email == "" ||
        self.password == "" ||
        self.password_confirmation == "" ||
        self.school_name == ""
      ) {
        self.$alert("Please fill al fields.");
      } else {
        axios
          .post(
            this.$apiAdress + "/sign-up",
            {
              name: self.name,
              email: self.email,
              password: self.password,
              password_confirmation: self.password_confirmation,
              school_name: self.school_name,
            },
            {
              headers: {
                Accept: "application/json",
              },
            }
          )
          .then(function (response) {
            self.name = "";
            self.email = "";
            self.password = "";
            self.password_confirmation = "";
            self.school_name = "";

            console.log(response);
            alert(response.data.message);
            self.$router.push({ path: "/admin-login" });
          })
          .catch(function (error) {
            console.error(error);
            alert(error.response.data.message);
          });
      }
    },
  },
};
</script>
