<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
defineOptions({ layout: UserLayout });
</script>

<template>
    <div class="secretary-container">
        <h1>Secretary of State Registration</h1>

        <div class="intro-section">
            <p>
                PawPal is a registered business entity in compliance with all necessary regulations and requirements set forth by the Securities and
                Exchange Commission (SEC) of the Philippines.
            </p>
        </div>

        <div class="registration-section">
            <section>
                <h2>Business Registration</h2>
                <div class="registration-info">
                    <div class="info-card">
                        <h3>Company Details</h3>
                        <ul>
                            <li>Registered Name: PawPal Corporation</li>
                            <li>Registration Number: SEC-2024-0123</li>
                            <li>Date of Incorporation: January 2024</li>
                            <li>Business Type: Corporation</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section>
                <h2>Compliance Information</h2>
                <div class="compliance-grid">
                    <div class="compliance-card">
                        <h3>Business Permits</h3>
                        <ul>
                            <li>Mayor's Permit</li>
                            <li>BIR Registration</li>
                            <li>Barangay Clearance</li>
                            <li>Fire Safety Permit</li>
                        </ul>
                    </div>
                    <div class="compliance-card">
                        <h3>Professional Licenses</h3>
                        <ul>
                            <li>Veterinary Practice License</li>
                            <li>Pharmacy License</li>
                            <li>Sanitary Permit</li>
                        </ul>
                    </div>
                </div>
            </section>

            <section>
                <h2>Corporate Governance</h2>
                <ul>
                    <li>Regular submission of annual reports</li>
                    <li>Compliance with SEC regulations</li>
                    <li>Updated business documentation</li>
                    <li>Regular audit compliance</li>
                </ul>
            </section>

            <section>
                <h2>Business Operations</h2>
                <div class="operations-info">
                    <p>Our operations comply with:</p>
                    <ul>
                        <li>Consumer Protection Laws</li>
                        <li>Animal Welfare Regulations</li>
                        <li>Health and Safety Standards</li>
                        <li>Environmental Guidelines</li>
                    </ul>
                </div>
            </section>

            <section>
                <h2>Contact Information</h2>
                <div class="contact-details">
                    <div class="contact-card">
                        <h3>Business Office</h3>
                        <p>123 1 King Charles corner king alexander kingspoint subdivision, Novaliches, Philippines</p>
                        <p>Phone: 0929 494 4937</p>
                        <p>Email: peppapets.ph@gmail.com</p>
                    </div>
                    <div class="contact-card">
                        <h3>Operating Hours</h3>
                        <p>Monday: 8:00 AM - 6:00 PM</p>
                        <p>Tuesday: CLOSED</p>
                        <p>Wednesday - Thursday: 8:00 AM - 6:00 PM</p>
                        <p>Friday - Sunday: 8:00 AM - 8:00 PM</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<style scoped>
.secretary-container {
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

.registration-section {
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

.info-card,
.compliance-card,
.contact-card {
    background-color: white;
    padding: 1.5rem;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.compliance-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.contact-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
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

@media (max-width: 768px) {
    .secretary-container {
        padding: 1rem;
    }

    h1 {
        font-size: 2rem;
    }

    section {
        padding: 1.5rem;
    }

    .compliance-grid,
    .contact-details {
        grid-template-columns: 1fr;
    }
}
</style>
