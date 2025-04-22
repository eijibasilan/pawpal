<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
defineOptions({ layout: UserLayout });
</script>

<template>
    <div class="help-container">
        <div class="header-section">
            <h1>Help Centre</h1>
            <p class="subtitle">How can we help you today?</p>
        </div>

        <div class="help-grid">
            <div class="help-card">
                <h2>In-Store Services</h2>
                <ul>
                    <li><a href="#">Store locations & hours</a></li>
                    <li><a href="#">Available payment methods</a></li>
                    <li><a href="#">Service booking process</a></li>
                    <li><a href="#">Walk-in appointments</a></li>
                </ul>
            </div>

            <div class="help-card">
                <h2>Pet Care Services</h2>
                <ul>
                    <li><a href="#">Grooming Services</a></li>
                    <li><a href="#">Pet Hotel & Boarding</a></li>
                    <li><a href="#">Veterinary Care</a></li>
                    <li><a href="#">Pet Health Advice</a></li>
                </ul>
            </div>

            <div class="help-card">
                <h2>Prescriptions</h2>
                <ul>
                    <li><a href="/prescription">Prescription information</a></li>
                    <li><a href="#">Ordering prescription items</a></li>
                    <li><a href="#">Written prescriptions</a></li>
                    <li><a href="#">Repeat prescriptions</a></li>
                </ul>
            </div>

            <div class="help-card">
                <h2>Account & Registration</h2>
                <ul>
                    <li><a href="#">Managing your account</a></li>
                    <li><a href="#">Password reset</a></li>
                    <li><a href="#">Pet registration guide</a></li>
                    <li><a href="#">Updating pet information</a></li>
                </ul>
            </div>

            <div class="help-card">
                <h2>Pet Health Hub</h2>
                <ul>
                    <li><a href="#">Pet care guides</a></li>
                    <li><a href="#">Nutrition advice</a></li>
                    <li><a href="#">Health tips</a></li>
                    <li><a href="#">Wellness resources</a></li>
                </ul>
            </div>

            <div class="help-card">
                <h2>Contact Us</h2>
                <ul>
                    <li><a href="tel:0929 494 4937">Call us: 0929 494 4937</a></li>
                    <li><a href="email:peppapets.ph@gmail.com">Email us: peppapets.ph@gmail.com</a></li>
                    <li>
                        <a href="loc:1 King Charles corner king alexander kingspoint subdivision, Novaliches, Philippines"
                            >Store Location: 1 King Charles corner king alexander kingspoint subdivision, Novaliches, Philippines</a
                        >
                    </li>
                </ul>
            </div>
        </div>

        <div class="contact-section">
            <h2>Still need help?</h2>
            <p>Our customer service team is available from Monday to Sunday, 9am to 8pm</p>
            <div class="contact-buttons">
                <a href="tel:0929 494 4937" class="contact-button phone">Call Us</a>
                <a
                    href="mailto:peppapets.ph@gmail.com?subject=Help%20Center%20Inquiry&body=Address:%201%20King%20Charles%20corner%20king%20alexander%20kingspoint%20subdivision,%20Novaliches,%20Philippines"
                    class="contact-button email"
                    >Email Us</a
                >
            </div>
        </div>
    </div>
</template>

<style scoped>
.help-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.header-section {
    text-align: center;
    margin-bottom: 3rem;
}

.header-section h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
}

.subtitle {
    font-size: 1.2rem;
    color: #666;
}

.help-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.help-card {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.help-card h2 {
    color: #4682b4;
    font-size: 1.4rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.help-card ul {
    list-style: none;
    padding: 0;
}

.help-card li {
    margin-bottom: 1rem;
}

.help-card a {
    color: #444;
    text-decoration: none;
    transition: color 0.3s;
}

.help-card a:hover {
    color: #4682b4;
}

.contact-section {
    text-align: center;
    background-color: #f0f8ff;
    padding: 3rem;
    border-radius: 8px;
    margin-top: 2rem;
}

.contact-section h2 {
    color: #333;
    margin-bottom: 1rem;
}

.contact-section p {
    color: #666;
    margin-bottom: 2rem;
}

.contact-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.contact-button {
    display: inline-block;
    padding: 1rem 2rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s;
}

.contact-button.phone {
    background-color: #4682b4;
    color: white;
}

.contact-button.email {
    background-color: #fff;
    color: #4682b4;
    border: 2px solid #4682b4;
}

.contact-button:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .header-section h1 {
        font-size: 2rem;
    }

    .help-card {
        padding: 1.5rem;
    }

    .contact-buttons {
        flex-direction: column;
    }

    .contact-button {
        width: 100%;
        text-align: center;
    }
}
</style>
