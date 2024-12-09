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
    // Include the status in the response
    const responseData = await response // Parse the response JSON

    return { ...responseData, status: response.status }
  },
  async onResponseError({ response }) {
    console.error('Error during request:', response.status)

    const responseData = await response // Parse the response JSON
    throw { ...responseData, status: response.status }
  },

})
