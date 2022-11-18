<template>
    <section id="section-alerts">
        <div class="alert alert-success">
            <p class="mb-0">{{ message }}</p>
        </div>
    </section>
</template>
<script>
export default {
    props: {
            message: String,
        },
    }

</script>