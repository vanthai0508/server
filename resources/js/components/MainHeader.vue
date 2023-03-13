<template>
    <div class="menu">
        <router-link class="link" to="/">
            <p class="item-menu">
                Home
            </p>
        </router-link>
        <router-link class="link" to="/login">
            <p class="item-menu">
                Login
            </p>
        </router-link>
        <router-link class="link" to="/register">
            <p class="item-menu">
                Register
            </p>
        </router-link>
    </div>
</template>
<script>
export default {
    name: 'MainHeader'
}
</script>

<style>
    .menu {
        display: flex;
        justify-content: center;
    }

    .item-menu {
        margin: 10px;
        font-size: large;
        cursor: pointer;
        font-weight: 600;
    }

    .link {
        color: inherit;
        text-decoration: none;
    }
</style>
