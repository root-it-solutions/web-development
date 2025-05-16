<div id="zw-app">
    <div class="zw" v-if="this.$route.meta.app === 'zw'">
        <div class="zw__wrap">
            <zw-top-header></zw-top-header>
            <div class="zw__wrapp">
                <router-view name="content"></router-view>
                <router-view name="footer"></router-view>
            </div>
            <zw-skip-wizard></zw-skip-wizard>
        </div>
    </div>
    <div class="zd" v-else>
        <div class="g_plugin">
            <zd-top-header></zd-top-header>
            <div class="g_plugin__container">
                <zd-sidebar></zd-sidebar>
                <div class="g_plugin__content">
                    <router-view name="content"></router-view>
                </div>
            </div>
        </div>
    </div>
</div>