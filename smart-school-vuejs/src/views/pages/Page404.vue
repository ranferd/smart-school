<template>
  <CContainer class="d-flex align-items-center min-vh-100">
    <CRow class="w-100 justify-content-center">
      <CCol md="6">
        <div class="w-100">
          <div class="clearfix">
            <h1 class="float-left display-3 mr-4">404</h1>
            <h4 class="pt-3">Oops! You're lost.</h4>
            <p class="text-muted">
              The page you are looking for was not found.
            </p>
          </div>
          <CButton @click="goHome()" color="info">Back to Home</CButton>
        </div>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script>
export default {
  name: "Page404",
  methods: {
    goHome() {
      this.$router.push({ path: "dashboard" });
    },
  },
};
</script>
