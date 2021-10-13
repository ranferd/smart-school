<template>
  <CSidebar
    fixed
    :minimize="minimize"
    :show="show"
    @update:show="(value) => $store.commit('set', ['sidebarShow', value])"
  >
    <CSidebarBrand class="d-md-down-none" to="/">
      <CIcon
        class="d-block"
        name="logo"
        size="custom-size"
        :height="35"
        :viewBox="`0 0 ${minimize ? 110 : 556} 134`"
      />
    </CSidebarBrand>
    <CRenderFunction flat :content-to-render="nav" />
    <CSidebarMinimizer
      class="d-md-down-none"
      @click.native="$store.commit('set', ['sidebarMinimize', !minimize])"
    />
  </CSidebar>
</template>

<script>
import axios from "axios";
export default {
  name: "TheSidebar",
  data() {
    return {
      //minimize: false,
      nav: [],
      //show: true,
      buffor: [],
    };
  },
  computed: {
    show() {
      return this.$store.state.sidebarShow;
    },
    minimize() {
      return this.$store.state.sidebarMinimize;
    },
  },
  methods: {
    dropdown(data) {
      let result = {
        _name: "CSidebarNavDropdown",
        name: data["name"],
        route: data["href"],
        icon: data["icon"],
        _children: [],
      };
      for (let i = 0; i < data["elements"].length; i++) {
        if (data["elements"][i]["slug"] == "dropdown") {
          result._children.push(this.dropdown(data["elements"][i]));
        } else {
          result._children.push({
            _name: "CSidebarNavItem",
            name: data["elements"][i]["name"],
            to: data["elements"][i]["href"],
            icon: data["elements"][i]["icon"],
          });
        }
      }
      return result;
    },
    rebuildData(data) {
      this.buffor = [
        {
          _name: "CSidebarNav",
          _children: [],
        },
      ];
      for (let k = 0; k < data.length; k++) {
        switch (data[k]["slug"]) {
          case "link":
            if (data[k]["href"].indexOf("http") !== -1) {
              this.buffor[0]._children.push({
                _name: "CSidebarNavItem",
                name: data[k]["name"],
                href: data[k]["href"],
                icon: data[k]["icon"],
                target: "_blank",
              });
            } else {
              this.buffor[0]._children.push({
                _name: "CSidebarNavItem",
                name: data[k]["name"],
                to: data[k]["href"],
                icon: data[k]["icon"],
              });
            }
            break;
          case "title":
            this.buffor[0]._children.push({
              _name: "CSidebarNavTitle",
              _children: [data[k]["name"]],
            });
            break;
          case "dropdown":
            this.buffor[0]._children.push(this.dropdown(data[k]));
            break;
        }
      }
      return this.buffor;
    },
  },
  mounted() {
    this.$root.$on("toggle-sidebar", () => {
      const sidebarOpened = this.show === true || this.show === "responsive";
      this.show = sidebarOpened ? false : "responsive";
    });
    this.$root.$on("toggle-sidebar-mobile", () => {
      const sidebarClosed = this.show === "responsive" || this.show === false;
      this.show = sidebarClosed ? true : "responsive";
    });
    let self = this;

    console.log(this.$apiAdress);

    let roles = localStorage.getItem("roles");
    var menu = [
      {
        slug: "link",
        name: "Dashboard",
        href: "/",
        hasIcon: true,
        icon: "cil-speedometer",
        iconType: "coreui",
      },
    ];
    if (roles != null && roles == "school-admin") {
      menu.push({
        elements: [
          { href: "/users/index", hasIcon: true, slug: "link", name: "List" },
          {
            href: "/users/invite",
            hasIcon: true,
            slug: "link",
            name: "Invite",
          },
        ],
        slug: "dropdown",
        name: "Users",
        href: "/users",
        hasIcon: true,
        icon: "cil-user",
        iconType: "coreui",
      });
    } else if (roles != null && roles == "teacher") {
      menu.push({
        slug: "link",
        name: "Teachers",
        href: "/teachers",
        hasIcon: true,
        icon: "cil-user-female",
        iconType: "coreui",
      });
    } else if (roles != null && roles == "student") {
      menu.push({
        slug: "link",
        name: "Students",
        href: "/students",
        hasIcon: true,
        icon: "cil-people",
        iconType: "coreui",
      });
    } else {
      menu.push({
        slug: "link",
        name: "Login",
        href: "/login",
        hasIcon: true,
        icon: "cil-account-logout",
        iconType: "coreui",
      });
      menu.push({
        slug: "link",
        name: "Register",
        href: "/register",
        hasIcon: true,
        icon: "cil-account-logout",
        iconType: "coreui",
      });
    }

    self.nav = self.rebuildData(menu);
  },
};
</script>
