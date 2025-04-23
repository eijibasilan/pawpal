<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { ref } from 'vue';

defineOptions({ layout: UserLayout });

const helpSections = ref([
    {
        title: 'In-Store Services',
        items: [
            {
                question: 'What are your store hours?',
                answer: 'Monday: 8:00 AM - 6:00 PM\nTuesday: CLOSED\nWednesday - Thursday: 8:00 AM - 6:00 PM\nFriday - Sunday: 8:00 AM - 8:00 PM',
                isOpen: false
            },
            {
                question: 'What payment methods do you accept?',
                answer: 'We accept cash and GCash payments. Payment is required at the time of service.',
                isOpen: false
            },
            {
                question: 'Do I need an appointment?',
                answer: 'While we accept walk-ins, we recommend scheduling an appointment to minimize waiting time. Emergency cases are always given priority.',
                isOpen: false
            },
            {
                question: 'Where are you located?',
                answer: '1 King Charles corner king alexander kingspoint subdivision, Novaliches, Philippines',
                isOpen: false
            }
        ]
    },
    {
        title: 'Pet Care Services',
        items: [
            {
                question: 'What grooming services do you offer?',
                answer: 'We provide professional grooming services including bathing, haircuts, nail trimming, and ear cleaning.',
                isOpen: false
            },
            {
                question: 'Do you offer boarding services?',
                answer: 'Yes, we provide comfortable boarding facilities with 24/7 supervision and daily exercise routines.',
                isOpen: false
            },
            {
                question: 'What veterinary services are available?',
                answer: 'We provide comprehensive veterinary care including wellness exams, vaccinations, dental care, and treatment for illnesses and injuries.',
                isOpen: false
            },
            {
                question: "What should I bring for my pet's appointment?",
                answer: "Please bring any previous medical records, vaccination history, and current medications.",
                isOpen: false
            }
        ]
    },
    {
        title: 'Prescriptions',
        items: [
            {
                question: 'How do I order prescription items?',
                answer: 'Prescriptions require a valid veterinary consultation. Once approved, you can order through our website or in-store.',
                isOpen: false
            },
            {
                question: 'How do repeat prescriptions work?',
                answer: 'Contact our clinic at least 48 hours in advance for repeat prescriptions. We\'ll review your pet\'s records before issuing.',
                isOpen: false
            },
            {
                question: 'Do you offer prescription delivery?',
                answer: 'We do not offer direct delivery services. Prescriptions must be picked up in-store.',
                isOpen: false
            }
        ]
    },
    {
        title: 'Account & Registration',
        items: [
            {
                question: 'How do I create an account?',
                answer: 'You can create an account by clicking the "Register" button and following the registration process.',
                isOpen: false
            },
            {
                question: 'How do I reset my password?',
                answer: 'Click on the "Forgot Password" link on the login page and follow the instructions sent to your email.',
                isOpen: false
            },
            {
                question: 'How do I update my pet\'s information?',
                answer: 'Log into your account, go to Pet Profiles, and select the pet whose information you want to update.',
                isOpen: false
            }
        ]
    }
]);

const toggleQuestion = (sectionIndex: number, questionIndex: number) => {
    helpSections.value[sectionIndex].items[questionIndex].isOpen = 
        !helpSections.value[sectionIndex].items[questionIndex].isOpen;
};
</script>

<template>
    <div class="help-container">
        <div class="header-section">
            <h1>Help Centre</h1>
            <p class="subtitle">How can we help you today?</p>
        </div>

        <div class="help-grid">
            <div v-for="(section, sectionIndex) in helpSections" :key="section.title" class="help-card">
                <h2>{{ section.title }}</h2>
                <div class="accordion">
                    <div 
                        v-for="(item, itemIndex) in section.items" 
                        :key="itemIndex"
                        class="accordion-item"
                    >
                        <div 
                            class="accordion-header"
                            @click="toggleQuestion(sectionIndex, itemIndex)"
                        >
                            <h3>{{ item.question }}</h3>
                            <span class="toggle-icon">{{ item.isOpen ? '−' : '+' }}</span>
                        </div>
                        <div 
                            class="accordion-content"
                            :class="{ 'is-open': item.isOpen }"
                            v-show="item.isOpen"
                        >
                            <p>{{ item.answer }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-box">
            <h3>Need additional assistance?</h3>
            <p>Our team is here to help. Contact us at:</p>
            <a href="tel:0929 494 4937" class="phone-link">0929 494 4937</a>
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
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-bottom: 4rem;
}

.help-card {
    background-color: #f8f9fa;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    height: fit-content;
    min-height: 400px;
}

.accordion {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.accordion-item {
    border-bottom: 1px solid #e9ecef;
    margin-bottom: 0.5rem;
}

.accordion-header {
    padding: 1rem;
    background-color: white;
    border-radius: 4px;
}

.accordion-content {
    padding: 1rem;
    background-color: #ffffff;
    border-radius: 0 0 4px 4px;
}

@media (max-width: 1200px) {
    .help-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .help-grid {
        grid-template-columns: 1fr;
    }
    
    .help-card {
        min-height: auto;
    }
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

.contact-box {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: #f0f8ff;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.contact-box h3 {
    color: #4682b4;
    font-size: 1.4rem;
    margin-bottom: 1rem;
}

.contact-box p {
    color: #666;
    margin-bottom: 1rem;
}

.phone-link {
    display: inline-block;
    color: #4682b4;
    font-size: 1.3rem;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s;
}

.phone-link:hover {
    color: #386890;
    text-decoration: underline;
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

.accordion-item {
    border-bottom: 1px solid #e9ecef;
}

.accordion-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.accordion-header:hover {
    color: #4682b4;
}

.accordion-header h3 {
    font-size: 1rem;
    margin: 0;
    color: inherit;
}

.toggle-icon {
    font-size: 1.5rem;
    color: #4682b4;
}

.accordion-content {
    padding: 0 0 1rem;
    color: #666;
    line-height: 1.6;
}

.accordion-content p {
    margin: 0;
    white-space: pre-line;
}
</style>
