export default {
    install: (app) => {
        app.config.globalProperties.isDarkmodeEnabled = () => {
            return localStorage.getItem('darkMode') === 'true';
        }

        app.provide('darkmode')
    }
}
