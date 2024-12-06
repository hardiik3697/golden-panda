import { ofetch } from 'ofetch'

export const $api = ofetch.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || '/api',
  async onRequest({ options }) {
    const accessToken = useCookie('accessToken').value
    if (accessToken) {
      options.headers = {
        ...options.headers,
        Accept: 'application/json',
        Authorization: `Bearer ${accessToken}`,
      }
    }
  },
  async onResponse({ response }) {
    // Attach the status code to the response data

    const data = response
    const statusCode = response.status

    return { ...data, statusCode } // Merge the status with the JSON response
  },
})
