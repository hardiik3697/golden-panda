<script setup>
import { useAbility } from '@casl/vue'
import authV2LoginIllustrationBorderedDark from '@images/pages/auth-v2-login-illustration-bordered-dark.png'
import authV2LoginIllustrationBorderedLight from '@images/pages/auth-v2-login-illustration-bordered-light.png'
import authV2LoginIllustrationDark from '@images/pages/auth-v2-login-illustration-dark.png'
import authV2LoginIllustrationLight from '@images/pages/auth-v2-login-illustration-light.png'
import authV2LoginMaskDark from '@images/pages/auth-v2-login-mask-dark.png'
import authV2LoginMaskLight from '@images/pages/auth-v2-login-mask-light.png'
import { VNodeRenderer } from '@layouts/components/VNodeRenderer'
import { themeConfig } from '@themeConfig'
import { useRoute, useRouter } from 'vue-router'
import { VForm } from 'vuetify/components/VForm'

const authThemeImg = useGenerateImageVariant(authV2LoginIllustrationLight, authV2LoginIllustrationDark, authV2LoginIllustrationBorderedLight, authV2LoginIllustrationBorderedDark, true)
const authThemeMask = useGenerateImageVariant(authV2LoginMaskLight, authV2LoginMaskDark)

definePage({
    meta: {
        layout: 'blank',
        unauthenticatedOnly: true,
    },
})

const isPasswordVisible = ref(false)
const route = useRoute()
const router = useRouter()
const ability = useAbility()

const errors = ref({
    email: undefined,
    password: undefined,
})

const refVForm = ref()

const credentials = ref({
    email: '',
    password: '',
})

const rememberMe = ref(false)

const login = async () => {
    try {
        const res = await $api('/login', {
            method: 'POST',
            body: {
                email: credentials.value.email,
                password: credentials.value.password,
            },
            onResponseError({ response }) {
                errors.value = response._data.errors
            },
        })

        const { accessToken, userData, userAbilityRules } = res

        useCookie('userAbilityRules').value = userAbilityRules
        ability.update(userAbilityRules)
        useCookie('userData').value = userData
        useCookie('accessToken').value = accessToken
        await nextTick(() => {
            router.push(route.query.to ? String(route.query.to) : '/')
        })
    } catch (err) {
        console.error(err)
        // showToast('An unexpected error occurred. Please try again.')
    }
}

const onSubmit = () => {
    refVForm.value?.validate().then(({ valid: isValid }) => {
        if (isValid)
            login()
    })
}
</script>

<template>
    <RouterLink to="/">
        <div class="auth-logo app-logo">
            <VNodeRenderer :nodes="themeConfig.app.logo" />
            <h1 class="app-logo-title">
                {{ themeConfig.app.title }}
            </h1>
        </div>
    </RouterLink>

    <VRow no-gutters class="auth-wrapper">
        <VCol md="8" class="d-none d-md-flex align-center justify-center position-relative">
            <div class="d-flex align-center justify-center pa-10">
                <img :src="authThemeImg" class="auth-illustration w-100" alt="auth-illustration">
            </div>
            <VImg :src="authThemeMask" class="d-none d-md-flex auth-footer-mask" alt="auth-mask" />
        </VCol>

        <VCol cols="12" md="4" class="auth-card-v2 d-flex align-center justify-center"
            style="background-color: rgb(var(--v-theme-surface));">
            <VCard flat :max-width="500" class="mt-12 mt-sm-0 pa-5 pa-lg-7">
                <VCardText>
                    <h4 class="text-h4 mb-1">
                        Welcome to <span class="text-capitalize">{{ themeConfig.app.title }}!</span>
                    </h4>
                </VCardText>

                <VCardText>
                    <VForm ref="refVForm" @submit.prevent="onSubmit">
                        <VRow>
                            <!-- email -->
                            <VCol cols="12">
                                <VTextField v-model="credentials.email" label="Email" placeholder="johndoe@email.com"
                                    type="email" autofocus :rules="[requiredValidator, emailValidator]"
                                    :error-messages="errors.email" />
                            </VCol>

                            <!-- password -->
                            <VCol cols="12">
                                <VTextField v-model="credentials.password" label="Password" placeholder="············"
                                    :rules="[requiredValidator]" :type="isPasswordVisible ? 'text' : 'password'"
                                    :error-messages="errors.password"
                                    :append-inner-icon="isPasswordVisible ? 'ri-eye-off-line' : 'ri-eye-line'"
                                    @click:append-inner="isPasswordVisible = !isPasswordVisible" />

                                <div class="d-flex align-center flex-wrap justify-space-between my-6 gap-x-2">
                                    <VCheckbox v-model="rememberMe" label="Remember me" />
                                </div>

                                <VBtn block type="submit">
                                    Login
                                </VBtn>
                            </VCol>
                        </VRow>
                    </VForm>
                </VCardText>
            </VCard>
        </VCol>
    </VRow>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth";
</style>
