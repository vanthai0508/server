<template>
    <div class="menu">
        <router-link class="link" to="/home">
            <p class="item-menu">
                Home
            </p>
        </router-link>
        
        <router-link class="link" to="/uploadFile">
            <p class="item-menu">
                Upload file
            </p>
        </router-link>

        <router-link class="link" to="/category">
            <p class="item-menu">
                Category
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
