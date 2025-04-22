<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { ref } from 'vue';

defineOptions({ layout: UserLayout });

const faqs = ref([
    {
        category: 'General Questions',
        items: [
            {
                question: 'What are your clinic hours?',
                answer: 'Our clinic is open Monday through Sunday from 9:00 AM to 8:00 PM, including public holidays. Our team is ready to assist you and your pets during these hours.',
                isOpen: false,
            },
            {
                question: 'What payment methods do you accept?',
                answer: 'We accept cash and GCash payments. Payment is required at the time of service.',
                isOpen: false,
            },
            {
                question: 'Do you accept pet insurance?',
                answer: 'No, we currently do not accept pet insurance. All payments must be made directly through cash or GCash.',
                isOpen: false,
            },
            {
                question: 'Where are you located?',
                answer: "Our clinic is located at 1 King Charles corner king alexander kingspoint subdivision, Novaliches, Philippines. We're easily accessible by public transportation and have parking available for our clients.",
                isOpen: false,
            },
            {
                question: 'Do I need to make an appointment?',
                answer: 'While we accept walk-ins, we recommend scheduling an appointment to minimize waiting time. Emergency cases are always given priority.',
                isOpen: false,
            },
            {
                question: 'What areas do you service?',
                answer: 'We serve the greater Manila area and surrounding neighborhoods. For specific location queries, please contact our clinic.',
                isOpen: false,
            },
            {
                question: 'Do you have emergency services?',
                answer: 'Yes, we provide emergency veterinary services during our operating hours. Please call ahead if possible so we can prepare for your arrival.',
                isOpen: false,
            },
            {
                question: 'Are there parking facilities available?',
                answer: 'Yes, we have dedicated parking spaces for our clients directly in front of the clinic.',
                isOpen: false,
            },
        ],
    },
    {
        category: 'Pet Care Services',
        items: [
            {
                question: 'What veterinary services do you offer?',
                answer: 'We provide comprehensive veterinary care including wellness exams, vaccinations, dental care, and treatment for illnesses and injuries.',
                isOpen: false,
            },
            {
                question: 'Do you offer grooming services?',
                answer: 'Yes, we provide professional grooming services including bathing, haircuts, nail trimming, and ear cleaning.',
                isOpen: false,
            },
            {
                question: "What should I bring for my pet's first visit?",
                answer: 'Please bring any previous medical records, vaccination history, and current medications.',
                isOpen: false,
            },
            {
                question: 'Do you offer pet boarding services?',
                answer: 'Yes, we provide comfortable boarding facilities with 24/7 supervision and daily exercise routines.',
                isOpen: false,
            },
            {
                question: 'What vaccination services are available?',
                answer: 'We offer all core and optional vaccinations for both dogs and cats, following international vaccination guidelines.',
                isOpen: false,
            },
            {
                question: 'Do you provide dental cleaning services?',
                answer: 'Yes, we offer professional dental cleaning, tooth extractions, and oral health assessments.',
                isOpen: false,
            },
            {
                question: 'What surgical procedures do you perform?',
                answer: 'We currently only perform spaying and neutering surgeries for cats and dogs. For other surgical procedures, we can provide referrals to specialized veterinary clinics.',
                isOpen: false,
            },
            {
                question: 'Do you offer microchipping?',
                answer: 'No, we currently do not offer microchipping services. We can provide referrals to other veterinary clinics that offer this service.',
                isOpen: false,
            },
        ],
    },
    {
        category: 'Prescriptions',
        items: [
            {
                question: 'How do prescriptions work?',
                answer: 'Prescriptions are provided after a veterinary consultation. For ongoing medications, we offer repeat prescription services.',
                isOpen: false,
            },
            {
                question: 'How do I request a repeat prescription?',
                answer: "Contact our clinic at least 48 hours in advance for repeat prescriptions. We'll review your pet's records before issuing.",
                isOpen: false,
            },
            {
                question: 'Can I get prescriptions without a consultation?',
                answer: 'No, all prescriptions require a recent veterinary consultation to ensure appropriate treatment.',
                isOpen: false,
            },
            {
                question: 'How long are prescriptions valid for?',
                answer: 'Prescription validity varies depending on the medication and condition. Your vet will advise on the specific duration.',
                isOpen: false,
            },
            {
                question: 'Do you offer prescription delivery?',
                answer: 'We do not offer direct delivery services. Prescriptions can be picked up in-store, or you may arrange delivery through third-party delivery apps of your choice.',
                isOpen: false,
            },
            {
                question: 'What happens if my pet needs a prescription change?',
                answer: "A consultation will be required to assess your pet's response to the current medication before making any changes.",
                isOpen: false,
            },
            {
                question: 'How do I store prescribed medications?',
                answer: 'Storage requirements vary by medication. We provide specific storage instructions with each prescription.',
                isOpen: false,
            },
            {
                question: 'What if my pet has an adverse reaction to medication?',
                answer: 'Contact us immediately if your pet shows any unusual reactions to prescribed medications.',
                isOpen: false,
            },
        ],
    },
]);

const toggleFAQ = (categoryIndex: number, itemIndex: number) => {
    faqs.value[categoryIndex].items[itemIndex].isOpen = !faqs.value[categoryIndex].items[itemIndex].isOpen;
};
</script>

<template>
    <div class="faq-container">
        <div class="header-section">
            <h1>Frequently Asked Questions</h1>
            <p class="subtitle">Find answers to common questions about our services</p>
        </div>

        <div class="faq-list">
            <div v-for="(category, categoryIndex) in faqs" :key="categoryIndex" class="faq-category">
                <h2 class="category-title">{{ category.category }}</h2>
                <div v-for="(faq, index) in category.items" :key="index" class="faq-item" :class="{ 'is-open': faq.isOpen }">
                    <div class="faq-question" @click="toggleFAQ(categoryIndex, index)">
                        <h3>{{ faq.question }}</h3>
                        <span class="toggle-icon">{{ faq.isOpen ? '−' : '+' }}</span>
                    </div>
                    <div class="faq-answer" v-show="faq.isOpen">
                        <p>{{ faq.answer }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-section">
            <h2>Still have questions?</h2>
            <p>Our team is here to help! Contact us for more information.</p>
            <div class="contact-buttons">
                <a href="tel:099110992" class="contact-button phone">Call Us</a>
                <a href="#" class="contact-button email">Email Us</a>
            </div>
        </div>
    </div>
</template>

<style scoped>
.faq-container {
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

.faq-list {
    max-width: 800px;
    margin: 0 auto 4rem;
}

.faq-item {
    background-color: #f8f9fa;
    border-radius: 8px;
    margin-bottom: 1rem;
    overflow: hidden;
}

.faq-question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.faq-question:hover {
    background-color: #f0f0f0;
}

.faq-question h2 {
    color: #4682b4;
    font-size: 1.1rem;
    margin: 0;
    flex: 1;
}

.toggle-icon {
    font-size: 1.5rem;
    color: #4682b4;
    font-weight: bold;
    margin-left: 1rem;
}

.faq-answer {
    padding: 0 1.5rem 1.5rem;
    color: #444;
    line-height: 1.6;
}

.is-open .faq-question {
    border-bottom: 1px solid #e9ecef;
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

    .faq-grid {
        grid-template-columns: 1fr;
    }

    .faq-card {
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
.faq-category {
    margin-bottom: 3rem;
}

.category-title {
    color: #333;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #4682b4;
}

.faq-question h3 {
    color: #4682b4;
    font-size: 1.1rem;
    margin: 0;
    flex: 1;
}
</style>
