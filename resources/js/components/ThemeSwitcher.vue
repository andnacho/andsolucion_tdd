<template>
    <div class="mr-10 flex items-center">
        <button v-for="(color, theme) in themes" class="rounded-full w-4 h-4 border mr-2 focus:outline-none"
                @click="selectedTheme = theme" :class="{'border-accent': selectedTheme == theme}"
                :style="{backgroundColor: color}" :title="sayColor(theme)"></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                themes: {
                    'theme-light': '#e1e1e1',
                    'theme-dark': '#222',
                    'theme-ocean': '#a7c1ea'
                },
                selectedTheme: ''
            };
        },

        created(){
          this.selectedTheme = localStorage.getItem('theme') || 'theme-light';
        },

        watch: {
            selectedTheme() {
                document.body.className = document.body.className.replace(/theme-\w+/, this.selectedTheme);

                localStorage.setItem('theme', this.selectedTheme);
            }
        },

        methods:{
            sayColor(color){
                if(color == 'theme-light') return 'Lightness';
                else if(color == 'theme-dark') return 'Darkness';
                if(color == 'theme-ocean') return 'Oceanic';
            }
        }

    }
</script>
