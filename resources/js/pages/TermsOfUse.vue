<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { h } from 'vue';

defineOptions({
    layout: h(UserLayout),
});
</script>

<template>
    <div class="terms-container">
        <h1>Terms of Website Use</h1>

        <div class="terms-section">
            <section>
                <h2>1. Website Access</h2>
                <p>Access to and use of PawPal's website is provided free of charge. We do not guarantee that access will be uninterrupted or error-free. Access may be suspended temporarily without notice for system maintenance, upgrades, or other issues.</p>
            </section>

            <section>
                <h2>2. Account Registration</h2>
                <ul>
                    <li>You must register an account to access certain features</li>
                    <li>You are responsible for maintaining your account security</li>
                    <li>Account information must be accurate and up-to-date</li>
                    <li>One account per user is permitted</li>
                </ul>
            </section>

            <section>
                <h2>3. Online Booking System</h2>
                <ul>
                    <li>Appointments made through the website are subject to confirmation</li>
                    <li>Accurate information must be provided when booking</li>
                    <li>Online booking is not suitable for emergencies</li>
                    <li>Cancellation policies apply to online bookings</li>
                </ul>
            </section>

            <section>
                <h2>4. User Conduct</h2>
                <ul>
                    <li>Do not misuse or interfere with website functionality</li>
                    <li>Respect other users and staff members</li>
                    <li>Do not submit false or misleading information</li>
                    <li>Do not attempt unauthorized access to our systems</li>
                </ul>
            </section>

            <section>
                <h2>5. Privacy & Data Protection</h2>
                <ul>
                    <li>Your data is protected as per our Privacy Policy</li>
                    <li>Cookies are used to improve website functionality</li>
                    <li>We do not share personal information with third parties</li>
                    <li>You can request access to your stored data</li>
                </ul>
            </section>

            <section>
                <h2>6. Intellectual Property</h2>
                <ul>
                    <li>All website content is protected by copyright</li>
                    <li>No content may be reproduced without permission</li>
                    <li>Our logo and branding are registered trademarks</li>
                    <li>User-submitted content remains your property</li>
                </ul>
            </section>

            <section>
                <h2>7. Technical Requirements</h2>
                <ul>
                    <li>Users are responsible for their internet connection</li>
                    <li>The website works best with modern browsers</li>
                    <li>Mobile devices are supported through responsive design</li>
                    <li>JavaScript must be enabled for full functionality</li>
                </ul>
            </section>

            <section>
                <h2>8. Limitation of Liability</h2>
                <p>We are not liable for any damages arising from website use, including but not limited to direct, indirect, incidental, or consequential damages.</p>
            </section>
        </div>

        <div class="contact-info">
            <p>If you have questions about website use, please contact:</p>
            <p>Email: peppapets.ph@gmail.com</p>
            <p>Technical Support: 0991 109 9244</p>
        </div>
    </div>
</template>

<style scoped>
.terms-container {
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

.terms-section {
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
    .terms-container {
        padding: 1rem;
    }

    h1 {
        font-size: 2rem;
    }

    section {
        padding: 1.5rem;
    }
}
</style>