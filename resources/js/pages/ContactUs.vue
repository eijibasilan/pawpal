<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { h } from 'vue';

defineOptions({
    layout: h(UserLayout),
});
</script>

<template>
    <div class="contact-container">
        <div class="header-section">
            <h1>Contact Us</h1>
            <p class="intro-text">
                Welcome to PawPal's support center! While our website is designed to be easy to navigate, 
                we know sometimes you might want to speak with us directly. Our friendly team is here 
                to assist you with any questions about our pet care services and products.
            </p>
        </div>

        <div class="contact-details">
            <div class="detail-section">
                <h2>Email:</h2>
                <p><a href="mailto:support@pawpal.com" class="highlight">support@pawpal.com</a></p>
            </div>

            <div class="detail-section">
                <h2>Phone number:</h2>
                <p class="highlight">099110992</p>
            </div>

            <div class="detail-section">
                <h2>Our customer services team is available:</h2>
                <p>Monday - Sunday: 9:00 AM - 8:00 PM</p>
                <p>Including Public Holidays</p>
            </div>

            <div class="detail-section">
                <h2>Address:</h2>
                <div class="address">
                    <p>PawPal</p>
                    <p>123 Pet Street</p>
                    <p>Manila</p>
                </div>
            </div>

            <div class="detail-section">
                <h2>Social Media:</h2>
                <div class="social-links">
                    <a href="https://www.facebook.com/PeppaPetsPH" target="_blank">Facebook</a>
                    <a href="https://instagram.com/peppapets" target="_blank">Instagram</a>
                </div>
            </div>

            <p class="response-note">Please allow up to 24 hours to hear from us.</p>
        </div>
    </div>
</template>

<style scoped>
.contact-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

.header-section {
    margin-bottom: 3rem;
}

.header-section h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1.5rem;
}

.intro-text {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #555;
}

.contact-details {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
}

.detail-section {
    margin-bottom: 2rem;
}

.detail-section h2 {
    color: #4682b4;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.highlight {
    color: #4682b4;
    font-weight: 600;
    text-decoration: none;
}

.highlight:hover {
    text-decoration: underline;
}

.address p {
    margin: 0.2rem 0;
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-links a {
    color: #4682b4;
    text-decoration: none;
}

.social-links a:hover {
    text-decoration: underline;
}

.response-note {
    margin-top: 2rem;
    font-style: italic;
    color: #666;
}

@media (max-width: 768px) {
    .header-section h1 {
        font-size: 2rem;
    }

    .contact-details {
        padding: 1.5rem;
    }
}
</style>