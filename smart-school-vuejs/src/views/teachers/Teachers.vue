<template>
  <CRow>
    <CCol col="6" xl="6">
      <transition name="slide">
        <CCard>
          <CCardHeader> Teachers </CCardHeader>
          <CCardBody>
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{ dismissCountDown }}) {{ message }}
            </CAlert>
            <CDataTable
              hover
              striped
              :items="teachers"
              :fields="fields"
              :items-per-page="5"
              pagination
            >
            </CDataTable>
          </CCardBody>
        </CCard>
      </transition>
    </CCol>
    <CCol col="6" xl="6">
      <transition name="slide">
        <CCard>
          <CCardHeader> Students </CCardHeader>
          <CCardBody>
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{ dismissCountDown }}) {{ message }}
            </CAlert>
            <CDataTable
              hover
              striped
              :items="students"
              :fields="fields"
              :items-per-page="5"
              pagination
            >
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
  name: "Teachers",
  data: () => {
    return {
      teachers: [],
      students: [],
      fields: ["id", "name", "email", "username", "role"],
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
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
    getTeachers() {
      let self = this;
      axios
        .get(this.$apiAdress + "/teachers", {
          headers: {
            Accept: "application/json",
            Authorization: "Bearer " + localStorage.getItem("api_token"),
          },
        })
        .then(function (response) {
          console.log(response);
          self.teachers = response.data.data.users;
        })
        .catch(function (error) {
          console.log(error);
          self.$router.push({ path: "/login" });
        });
    },
    getStudents() {
      let self = this;
      axios
        .get(this.$apiAdress + "/students", {
          headers: {
            Accept: "application/json",
            Authorization: "Bearer " + localStorage.getItem("api_token"),
          },
        })
        .then(function (response) {
          console.log(response);
          self.students = response.data.data.users;
        })
        .catch(function (error) {
          console.log(error);
          self.$router.push({ path: "/login" });
        });
    },
  },
  mounted: function () {
    this.getTeachers();
    this.getStudents();
  },
};
</script>
