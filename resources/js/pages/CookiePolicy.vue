<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
defineOptions({ layout: UserLayout });
</script>

<template>
    <div class="policy-container">
        <h1>Cookie Policy</h1>

        <div class="intro-section">
            <p>
                At PawPal, we use cookies and similar technologies to enhance your browsing experience and provide personalized service. This policy
                explains how we use these technologies and your choices regarding them.
            </p>
        </div>

        <div class="policy-section">
            <section>
                <h2>Understanding Cookies</h2>
                <p>
                    Cookies are small data files stored on your device that help us improve your experience. We use different types of cookies for
                    various purposes:
                </p>
                <div class="cookie-types">
                    <div class="cookie-type">
                        <h3>Strictly Necessary</h3>
                        <p>Essential for basic website functions and security. Cannot be disabled.</p>
                    </div>
                    <div class="cookie-type">
                        <h3>Performance</h3>
                        <p>Help us understand how visitors interact with our website.</p>
                    </div>
                    <div class="cookie-type">
                        <h3>Functionality</h3>
                        <p>Remember your preferences for a better experience.</p>
                    </div>
                </div>
            </section>

            <section>
                <h2>Cookie Details</h2>
                <div class="cookie-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Purpose</th>
                                <th>Duration</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>session_id</td>
                                <td>Manages user session</td>
                                <td>Session</td>
                                <td>Essential</td>
                            </tr>
                            <tr>
                                <td>preferences</td>
                                <td>Stores user preferences</td>
                                <td>1 year</td>
                                <td>Functional</td>
                            </tr>
                            <tr>
                                <td>analytics</td>
                                <td>Website usage statistics</td>
                                <td>2 years</td>
                                <td>Performance</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="browser-section">
                <h2>Managing Cookies in Your Browser</h2>
                <div class="browser-controls">
                    <div class="browser-info">
                        <h3>Chrome</h3>
                        <p>Settings → Privacy and Security → Cookies</p>
                    </div>
                    <div class="browser-info">
                        <h3>Firefox</h3>
                        <p>Options → Privacy & Security → Cookies</p>
                    </div>
                    <div class="browser-info">
                        <h3>Safari</h3>
                        <p>Preferences → Privacy → Cookies</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<style scoped>
.policy-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

h1 {
    color: #333;
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.last-updated {
    color: #666;
    margin-bottom: 3rem;
    font-style: italic;
}

.policy-section {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

section {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

h2 {
    color: #4682b4;
    font-size: 1.4rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

p {
    color: #444;
    line-height: 1.6;
    margin-bottom: 1rem;
}

ul {
    list-style: disc;
    padding-left: 1.5rem;
    color: #444;
    line-height: 1.6;
}

li {
    margin-bottom: 0.5rem;
}

.cookie-table {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

th,
td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e9ecef;
}

th {
    background-color: #4682b4;
    color: white;
}

tr:nth-child(even) {
    background-color: #f8f9fa;
}

.contact-info {
    margin-top: 3rem;
    padding: 2rem;
    background-color: #f0f8ff;
    border-radius: 8px;
    text-align: center;
}

.contact-info p {
    margin-bottom: 0.5rem;
}

@media (max-width: 768px) {
    .policy-container {
        padding: 1rem;
    }

    h1 {
        font-size: 2rem;
    }

    section {
        padding: 1.5rem;
    }

    th,
    td {
        padding: 0.75rem;
    }
}
</style>
