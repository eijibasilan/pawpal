    <script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { h } from 'vue';

defineOptions({
    layout: h(UserLayout),
});
</script>

<template>
    <div class="registration-container">
        <h1>Registered Internet Retailer of Veterinary Medicines</h1>

        <div class="registration-section">
            <section>
                <h2>Our Registration</h2>
                <div class="registration-info">
                    <p>PawPal is a registered internet retailer of veterinary medicines, authorized by the Food and Drug Administration (FDA) of the Philippines.</p>
                    <div class="registration-details">
                        <p><strong>Registration Number:</strong> VMD-2024-001</p>
                        <p><strong>Valid Until:</strong> December 31, 2024</p>
                    </div>
                </div>
            </section>

            <section>
                <h2>Our Commitment</h2>
                <ul>
                    <li>Supply only genuine, FDA-approved veterinary medicines</li>
                    <li>Maintain proper storage and handling conditions</li>
                    <li>Ensure accurate product information</li>
                    <li>Verify prescriptions when required</li>
                    <li>Maintain complete transaction records</li>
                </ul>
            </section>

            <section>
                <h2>Medicine Categories We Supply</h2>
                <div class="medicine-categories">
                    <div class="category-card">
                        <h3>Prescription Medicines</h3>
                        <p>Available only with valid veterinary prescription</p>
                    </div>
                    <div class="category-card">
                        <h3>Non-Prescription Medicines</h3>
                        <p>Over-the-counter veterinary medicines</p>
                    </div>
                    <div class="category-card">
                        <h3>Supplements</h3>
                        <p>Nutritional and health supplements</p>
                    </div>
                </div>
            </section>

            <section>
                <h2>Quality Assurance</h2>
                <ul>
                    <li>Regular quality audits</li>
                    <li>Temperature-controlled storage</li>
                    <li>Batch tracking system</li>
                    <li>Expiry date monitoring</li>
                    <li>Staff training program</li>
                </ul>
            </section>

            <section>
                <h2>Prescription Requirements</h2>
                <div class="requirements-list">
                    <p>For prescription medicines, we require:</p>
                    <ul>
                        <li>Valid prescription from a licensed veterinarian</li>
                        <li>Complete pet and owner information</li>
                        <li>Prescription date and validity period</li>
                        <li>Veterinarian's license number and signature</li>
                    </ul>
                </div>
            </section>

            <section class="contact-section">
                <h2>Regulatory Inquiries</h2>
                <div class="contact-info">
                    <p>For questions about our registration or medicine supply:</p>
                    <p>Email: peppapets.ph@gmail.com</p>
                    <p>Phone: 0929 494 4937</p>
                    <p>Office Hours: Monday to Friday, 9:00 AM - 5:00 PM</p>
                </div>
            </section>
        </div>
    </div>
</template>

<style scoped>
.registration-container {
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

.registration-info {
    background-color: white;
    padding: 1.5rem;
    border-radius: 6px;
    margin-top: 1rem;
}

.registration-details {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
}

.medicine-categories {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.category-card {
    background-color: white;
    padding: 1.5rem;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.requirements-list {
    background-color: white;
    padding: 1.5rem;
    border-radius: 6px;
    margin-top: 1rem;
}

.contact-info {
    background-color: white;
    padding: 1.5rem;
    border-radius: 6px;
    text-align: center;
}

@media (max-width: 768px) {
    .registration-container {
        padding: 1rem;
    }

    h1 {
        font-size: 2rem;
    }

    section {
        padding: 1.5rem;
    }

    .medicine-categories {
        grid-template-columns: 1fr;
    }
}
</style>