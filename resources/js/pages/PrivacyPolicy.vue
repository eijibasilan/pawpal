<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { h } from 'vue';

defineOptions({
    layout: h(UserLayout),
});
</script>

<template>
    <div class="policy-container">
        <h1>Privacy Policy</h1>

        <div class="intro-section">
            <p>At PawPal, we take your privacy seriously. This policy outlines how we collect, use, and protect your personal information when you use our veterinary services and website.</p>
        </div>

        <div class="policy-section">
            <section>
                <h2>Information We Collect</h2>
                <div class="info-grid">
                    <div class="info-card">
                        <h3>Personal Information</h3>
                        <ul>
                            <li>Name and contact details</li>
                            <li>Address and location</li>
                            <li>Payment information</li>
                            <li>Emergency contact details</li>
                        </ul>
                    </div>
                    <div class="info-card">
                        <h3>Pet Information</h3>
                        <ul>
                            <li>Pet names and breeds</li>
                            <li>Medical history</li>
                            <li>Treatment records</li>
                            <li>Vaccination records</li>
                        </ul>
                    </div>
                    <div class="info-card">
                        <h3>Website Usage</h3>
                        <ul>
                            <li>Browsing patterns</li>
                            <li>Device information</li>
                            <li>IP addresses</li>
                            <li>Cookie data</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section>
                <h2>How We Use Your Information</h2>
                <ul>
                    <li>Provide veterinary care and services</li>
                    <li>Process appointments and payments</li>
                    <li>Send appointment reminders and updates</li>
                    <li>Improve our services and website experience</li>
                    <li>Comply with legal obligations</li>
                    <li>Contact you in case of emergencies</li>
                </ul>
            </section>

            <section>
                <h2>Information Security</h2>
                <p>We implement appropriate security measures to protect your information:</p>
                <ul>
                    <li>Secure data storage and encryption</li>
                    <li>Regular security assessments</li>
                    <li>Staff training on data protection</li>
                    <li>Limited access to personal information</li>
                </ul>
            </section>

            <section>
                <h2>Your Rights</h2>
                <div class="rights-grid">
                    <div class="right-item">
                        <h3>Access</h3>
                        <p>Request copies of your personal data</p>
                    </div>
                    <div class="right-item">
                        <h3>Correction</h3>
                        <p>Update incorrect information</p>
                    </div>
                    <div class="right-item">
                        <h3>Deletion</h3>
                        <p>Request removal of your data</p>
                    </div>
                    <div class="right-item">
                        <h3>Restriction</h3>
                        <p>Limit how we use your data</p>
                    </div>
                </div>
            </section>

            <section>
                <h2>Contact Us</h2>
                <p>For privacy-related inquiries:</p>
                <div class="contact-details">
                    <p>Email: privacy@pawpal.com</p>
                    <p>Phone: 099110992</p>
                    <p>Address: 123 Pet Street, Manila</p>
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

.intro-section {
    background-color: #f0f8ff;
    padding: 2rem;
    border-radius: 8px;
    margin-bottom: 2rem;
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

h3 {
    color: #4682b4;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.info-grid, .rights-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.info-card, .right-item {
    background-color: white;
    padding: 1.5rem;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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

p {
    color: #444;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.contact-details {
    background-color: white;
    padding: 1.5rem;
    border-radius: 6px;
    margin-top: 1rem;
}

.contact-details p {
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

    .info-grid, .rights-grid {
        grid-template-columns: 1fr;
    }
}
</style>