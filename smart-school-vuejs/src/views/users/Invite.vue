<template>
  <CRow>
    <CCol col="12" lg="6">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
              Edit User id: {{ $route.params.id }}
            </template>
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{ dismissCountDown }}) {{ message }}
            </CAlert>
            <CSelect
              label="Role"
              :options="[
                { value: 'teacher', label: 'Teacher' },
                { value: 'student', label: 'Student' },
              ]"
              placeholder="Please select role"
              :value.sync="role"
            />
            <CInput
              type="text"
              label="Name"
              placeholder="Name"
              v-model="name"
            ></CInput>
            <CInput
              type="text"
              label="Username"
              placeholder="Username"
              v-model="username"
            ></CInput>
            <CInput
              type="text"
              label="Email"
              placeholder="Email"
              v-model="email"
            ></CInput>
            <CButton color="primary" @click="invite()">Invite</CButton>
            <CButton color="primary" @click="goBack">Back</CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";
export default {
  name: "Invite",
  props: {
    caption: {
      type: String,
      default: "User id",
    },
  },
  data: () => {
    return {
      role: "",
      name: "",
      username: "",
      email: "",
      showMessage: false,
      message: "",
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },
  methods: {
    goBack() {
      this.$router.go(-1);
      // this.$router.replace({path: '/users'})
    },
    invite() {
      let self = this;
      axios
        .post(
          this.$apiAdress + "/invite",
          {
            role: self.role,
            name: self.name,
            username: self.username,
            email: self.email,
          },
          {
            headers: {
              Accept: "application/json",
              Authorization: "Bearer " + localStorage.getItem("api_token"),
            },
          }
        )
        .then(function (response) {
          self.message = "Successfully invite user.";
          self.showAlert();
        })
        .catch(function (error) {
          console.log(error);
          self.$router.push({ path: "/login" });
        });
    },
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
  },
  mounted: function () {},
};
</script>
