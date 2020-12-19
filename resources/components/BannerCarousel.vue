<template>
    <div v-if="banners.length > 0">
        <div class="mb-5">        
            <div class="w-full bg-red-800 rounded transition duration-700 ease-in-out" 
                v-for="banner in banners"
                :key="banner.id"
                :class="banner.visible ? 'active block' : ' inactive hidden'">
                    <a :href="banner.url">
                        <img :src="`/storage/${banner.image_path}`" class="h-32 w-full" :alt="banner.alt_text" />
                    </a>
            </div>           
        </div>
        <div class="mt-5">
            <a href="#" @click.prevent="prevOnClick">Prev</a>
            <a href="#" @click.prevent="nextOnClick">Next</a>
        </div>
    </div>
</template>
<script>
export default {
    name: 'banner-carousel',
    props: ['initBanners'],
    data() {
        return {
            banners: null,
            current: 0
        }
    },
    methods: {
        prevOnClick() {
            this.current -= 1
            if (this.current < 0) {
                this.current = this.banners.length
            }
            this.updateBanners()
        },
        nextOnClick() {
            this.current += 1
            if (this.current > (this.banners.length - 1)) {
                this.current = 0
            }
            this.updateBanners()
        },
        updateBanners() {
            for (let i = 0; i < this.banners.length; i++) {
                this.banners[i]['visible'] = false
            }
            let updatedBanner = this.banners[this.current]
            updatedBanner.visible = true
            this.$set(this.banners, this.current, updatedBanner)
        }
    },
    mounted() {
        this.banners = this.initBanners
        for (let i = 0; i < this.banners.length; i++) {
            if (i === 0) {
                this.banners[i]['visible'] = true
            } else {
                this.banners[i]['visible'] = false
            }
        }
    }
}
</script>
