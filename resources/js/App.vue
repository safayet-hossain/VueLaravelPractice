<script setup>
import { ref } from "vue";

const count = ref(0);
</script>

<template>
    <div>
        <h2>Welcome to Laravel & VueJS app!</h2>
        <div>
            <div>{{ count }}</div>
            <div style="display: flex; gap: 10px">
                <button type="button" @click="count++">Add</button>
                <button type="button" @click="count--">Minus</button>
            </div>
        </div>

        <div style="display: flex; gap: 10px">
            <router-link to="/">Home</router-link>
            <router-link to="/about">About</router-link>
        </div>

        <router-view></router-view>
    </div>
</template>