<template>
  <CFooter :fixed="false">
    <div>
      <a href="#" target="_blank">Smart School</a>
      <span class="ml-1">&copy; {{ new Date().getFullYear() }} Randy F.</span>
    </div>
    <div class="ml-auto"></div>
  </CFooter>
</template>

<script>
export default {
  name: "TheFooter",
};
</script>
