<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
</script>

<template>
    <UserLayout>
        <div class="sitemap-container">
            <h1>Sitemap</h1>

            <div class="sitemap-section">
                <section>
                    <h2>Main Pages</h2>
                    <ul class="sitemap-list">
                        <li><a href="/">Home</a></li>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/contact">Contact Us</a></li>
                        <li><a href="/help-centre">Help Centre</a></li>
                    </ul>
                </section>

                <section>
                    <h2>Pet Services</h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="/services">Our Services</a>
                            <ul>
                                <li><a href="/services/veterinary">Veterinary Care</a></li>
                                <li><a href="/services/grooming">Pet Grooming</a></li>
                                <li><a href="/services/vaccination">Vaccination</a></li>
                                <li><a href="/services/dental">Dental Care</a></li>
                            </ul>
                        </li>
                        <li><a href="/book-appointment">Book Appointment</a></li>
                    </ul>
                </section>

                <section>
                    <h2>Pet Care Resources</h2>
                    <ul class="sitemap-list">
                        <li><a href="/pet-care">Pet Care Hub</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/how-to-register-your-pet">How To Register Your Pet</a></li>
                    </ul>
                </section>

                <section>
                    <h2>Account & Support</h2>
                    <ul class="sitemap-list">
                        <li>
                            <a href="/account">My Account</a>
                            <ul>
                                <li><a href="/account/profile">Profile Settings</a></li>
                                <li><a href="/account/pets">My Pets</a></li>
                                <li><a href="/account/appointments">My Appointments</a></li>
                            </ul>
                        </li>
                        <li><a href="/prescription">Prescription Regulations</a></li>
                    </ul>
                </section>

                <section>
                    <h2>Legal Information</h2>
                    <ul class="sitemap-list">
                        <li><a href="/terms-and-conditions">Terms & Conditions</a></li>
                        <li><a href="/terms-of-use">Terms of Website Use</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                        <li><a href="/cookie-policy">Cookie Policy</a></li>
                        <li><a href="/vet-medicines">Registered Internet Retailer of Veterinary Medicines</a></li>
                        <li><a href="/secretary">Secretary of State</a></li>
                    </ul>
                </section>
            </div>
        </div>
    </UserLayout>
</template>

<style scoped>
.sitemap-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem;
}

h1 {
    color: #333;
    font-size: 2.5rem;
    margin-bottom: 2rem;
}

.sitemap-section {
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

.sitemap-list {
    list-style: none;
    padding: 0;
}

.sitemap-list li {
    margin-bottom: 1rem;
}

.sitemap-list ul {
    list-style: none;
    padding-left: 1.5rem;
    margin-top: 0.5rem;
}

.sitemap-list ul li {
    margin-bottom: 0.5rem;
}

.sitemap-list a {
    color: #4682b4;
    text-decoration: none;
    transition: color 0.3s;
}

.sitemap-list a:hover {
    color: #2d5a88;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .sitemap-container {
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
