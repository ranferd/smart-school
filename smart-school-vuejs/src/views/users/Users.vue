<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
        <CCard>
          <CCardHeader> Users </CCardHeader>
          <CCardBody>
            <CButton color="primary" @click="goInvite()" class="mb-3"
              >Invite Teacher/Student</CButton
            >
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{ dismissCountDown }}) {{ message }}
            </CAlert>
            <CDataTable
              hover
              striped
              :items="items"
              :fields="fields"
              :items-per-page="5"
              pagination
            >
              <template #delete="{ item }">
                <td>
                  <CButton
                    v-if="you != item.id"
                    color="danger"
                    @click="deleteUser(item.id)"
                    >Delete</CButton
                  >
                </td>
              </template>
            </CDataTable>
          </CCardBody>
        </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import axios from "axios";

export default {
  name: "Users",
  data: () => {
    return {
      items: [],
      fields: ["id", "name", "email", "username", "role", "delete"],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      you: null,
      message: "",
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false,
    };
  },
  paginationProps: {
    align: "center",
    doubleArrows: false,
    previousButtonHtml: "prev",
    nextButtonHtml: "next",
  },
  methods: {
    goInvite() {
      this.$router.push({ path: "invite" });
    },
    deleteUser(id) {
      let self = this;
      axios
        .get(this.$apiAdress + "/user/" + id + "/delete", {
          headers: {
            Accept: "application/json",
            Authorization: "Bearer " + localStorage.getItem("api_token"),
          },
        })
        .then(function (response) {
          self.message = "Successfully deleted user.";
          self.showAlert();
          self.getUsers();
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
    getUsers() {
      let self = this;
      axios
        .get(this.$apiAdress + "/users", {
          headers: {
            Accept: "application/json",
            Authorization: "Bearer " + localStorage.getItem("api_token"),
          },
        })
        .then(function (response) {
          console.log(response);
          self.items = response.data.data.users;
        })
        .catch(function (error) {
          console.log(error);
          self.$router.push({ path: "/login" });
        });
    },
  },
  mounted: function () {
    this.getUsers();
  },
};
</script>
