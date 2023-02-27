<template>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class="bx bx-menu"></i></div>

            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#">
                            <i class="bx bx-search"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <a
                            class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <span class="alert-count">
                                {{ count_notification }}
                            </span>
                            <i class="bx bx-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifikacije</p>
                                    <a class="msg-header-clear ms-auto" href="">
                                        Označi kao pročitane
                                    </a>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                <a
                                    class="dropdown-item"
                                    href=""
                                    v-for="(
                                        notification, index
                                    ) in notifications"
                                    :key="index"
                                >
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="notify bg-light-danger text-danger"
                                        >
                                            <i class="bx bx-cart-alt"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">
                                                Broj porudžbenice
                                                <span
                                                    class="msg-time float-end"
                                                    >{{
                                                        notification.created_at
                                                            | fromTime
                                                    }}</span
                                                >
                                            </h6>
                                            <p class="msg-info">
                                                {{ notification.data.title }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a href="">
                                <div class="text-center msg-footer">
                                    Pogledaj sve notifikacije
                                </div>
                            </a>
                        </div>
                    </li>
                    <li
                        class="nav-item dropdown dropdown-large"
                        style="display: none"
                    >
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="">
                                <div class="msg-header">
                                    <p class="msg-header-title">Messages</p>
                                    <p class="msg-header-clear ms-auto">
                                        Marks all as read
                                    </p>
                                </div>
                            </a>
                            <div class="header-message-list"></div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a
                    class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <img
                        src="/assets/images/avatars/avatar-2.png"
                        class="user-img"
                        alt="user avatar"
                    />
                    <div class="user-info ps-3">
                        <!-- <p class="user-name mb-0">{{ Auth::user()?->name }}</p> -->
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href=""
                            ><i class="bx bx-user"></i><span>Profile</span></a
                        >
                    </li>

                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <a
                            class="dropdown-item"
                            href=""
                            @click.prevent="logout()"
                            ><i class="bx bx-log-out-circle"></i
                            ><span>Logout</span></a
                        >
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    data() {
        return {};
    },

    computed: {
        ...mapGetters({
            notifications: "notification/notifications",
            count_notification: "notification/count_notification",
        }),
    },

    mounted() {
        this.getNotifications();
    },

    methods: {
        ...mapActions({
            getNotifications: "notification/getNotifications",
        }),

        logout() {
            axios.post("/logout").then((resp) => {
                window.location.href = "/login";
            });
        },
    },
};
</script>
