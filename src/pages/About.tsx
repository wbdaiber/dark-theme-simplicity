
import { motion } from "framer-motion";
import { Book, Award, Clock, Users, ArrowRight, Briefcase, Lightbulb, Heart } from "lucide-react";
import Layout from "@/components/Layout";
import { Card, CardContent } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";

const About = () => {
  return (
    <Layout>
      <div className="pt-24 pb-16">
        {/* Hero Section */}
        <section className="container mx-auto px-4 pt-12 pb-16">
          <div className="max-w-3xl mx-auto text-center">
            <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
              About Me
            </Badge>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-display font-bold mb-6 tracking-tight">
              I help <span className="text-blue-300">businesses grow</span> through strategic content
            </h1>
            <p className="text-lg md:text-xl text-light-100/70 mb-8 max-w-2xl mx-auto">
              As an independent content strategist, I'm dedicated to helping businesses improve their online presence
              and reach their target audience through personalized content marketing.
            </p>
          </div>
        </section>
        
        {/* Mission & Values */}
        <section className="container mx-auto px-4 py-16">
          <div className="grid md:grid-cols-2 gap-12 items-center">
            <div>
              <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
                My Mission
              </Badge>
              <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 tracking-tight">
                Empowering businesses to thrive online
              </h2>
              <p className="text-light-100/70 mb-6">
                I believe that great content is the foundation of a successful online presence. My mission is to help businesses create content that engages their audience, ranks well in search engines, and converts visitors into customers.
              </p>
              <div className="space-y-4">
                {[
                  "Strategic content planning that aligns with your business goals",
                  "SEO-driven content that ranks well and drives traffic",
                  "Engaging writing that connects with your target audience",
                  "Data-driven approach to optimize performance"
                ].map((point, index) => (
                  <div key={index} className="flex items-start">
                    <div className="mr-3 mt-1 text-blue-300">
                      <ArrowRight size={16} />
                    </div>
                    <p className="text-light-100/80">{point}</p>
                  </div>
                ))}
              </div>
            </div>
            <div className="glass-card p-1 rounded-xl">
              <div className="relative w-full h-80 md:h-96 overflow-hidden rounded-lg">
                <img 
                  src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                  alt="Workspace with laptop" 
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>
        </section>
        
        {/* Stats */}
        <section className="container mx-auto px-4 py-16">
          <div className="glass-card bg-dark-100/50 p-8 rounded-xl">
            <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
              {[
                { number: "50+", label: "Clients", icon: Users },
                { number: "300+", label: "Articles", icon: Book },
                { number: "5+", label: "Industry Awards", icon: Award },
                { number: "7+", label: "Years Experience", icon: Clock },
              ].map((stat, index) => (
                <div key={index} className="text-center">
                  <div className="flex justify-center mb-4">
                    <div className="w-12 h-12 rounded-full bg-blue-300/20 flex items-center justify-center text-blue-300">
                      <stat.icon size={24} />
                    </div>
                  </div>
                  <h3 className="text-3xl font-bold font-display mb-1">{stat.number}</h3>
                  <p className="text-light-100/60">{stat.label}</p>
                </div>
              ))}
            </div>
          </div>
        </section>
        
        {/* My Story/Journey */}
        <section className="container mx-auto px-4 py-16">
          <div className="text-center mb-12">
            <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
              My Journey
            </Badge>
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 tracking-tight">
              How I got here
            </h2>
            <p className="text-light-100/70 max-w-2xl mx-auto">
              My path to becoming a content strategist has been shaped by a passion for storytelling and a dedication to helping businesses find their voice.
            </p>
          </div>
          
          <div className="max-w-3xl mx-auto space-y-12">
            {[
              {
                year: "2016",
                title: "The Beginning",
                icon: Briefcase,
                description: "After working in corporate marketing for 5 years, I took the leap to start my own content strategy business, focusing on helping small businesses gain visibility online."
              },
              {
                year: "2018",
                title: "Finding My Niche",
                icon: Lightbulb,
                description: "I discovered my passion for helping tech startups and SaaS companies communicate complex ideas in simple, engaging ways that convert visitors into customers."
              },
              {
                year: "2020",
                title: "Expanding Services",
                icon: Heart,
                description: "As my business grew, I expanded my service offerings to include comprehensive content strategies, SEO, and brand storytelling for businesses across various industries."
              },
              {
                year: "Present",
                title: "Where I Am Today",
                icon: Award,
                description: "Today, I work with businesses of all sizes to create content strategies that drive results. I'm passionate about helping my clients tell their stories in ways that resonate with their audience."
              }
            ].map((milestone, index) => (
              <div key={index} className="flex">
                <div className="mr-6">
                  <div className="w-12 h-12 rounded-full bg-blue-300/20 flex items-center justify-center text-blue-300">
                    <milestone.icon size={24} />
                  </div>
                  {index < 3 && (
                    <div className="h-full w-0.5 bg-blue-300/20 mx-auto mt-2"></div>
                  )}
                </div>
                <div className="flex-1">
                  <div className="flex items-center mb-2">
                    <span className="text-blue-300 font-medium mr-3">{milestone.year}</span>
                    <h3 className="text-xl font-bold">{milestone.title}</h3>
                  </div>
                  <p className="text-light-100/70">{milestone.description}</p>
                </div>
              </div>
            ))}
          </div>
        </section>
        
        {/* My Approach */}
        <section className="container mx-auto px-4 py-16">
          <div className="grid md:grid-cols-2 gap-12 items-center">
            <div className="glass-card p-1 rounded-xl order-2 md:order-1">
              <div className="relative w-full h-80 md:h-96 overflow-hidden rounded-lg">
                <img 
                  src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" 
                  alt="Working on laptop" 
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
            <div className="order-1 md:order-2">
              <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
                My Approach
              </Badge>
              <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 tracking-tight">
                How I work with clients
              </h2>
              <p className="text-light-100/70 mb-6">
                I believe in a collaborative approach to content strategy. Your business is unique, and your content strategy should be too. Here's how I work:
              </p>
              <div className="space-y-6">
                {[
                  {
                    title: "1. Discovery",
                    description: "I start by understanding your business, audience, and goals to create a tailored strategy."
                  },
                  {
                    title: "2. Strategy Development",
                    description: "Based on research and your goals, I develop a content strategy aligned with your business objectives."
                  },
                  {
                    title: "3. Implementation",
                    description: "I create content that engages your audience and drives the results you're looking for."
                  },
                  {
                    title: "4. Analysis & Optimization",
                    description: "I continuously monitor performance and optimize your content strategy for better results."
                  }
                ].map((step, index) => (
                  <div key={index}>
                    <h3 className="text-xl font-bold mb-2">{step.title}</h3>
                    <p className="text-light-100/70">{step.description}</p>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </section>

        {/* CTA */}
        <section className="container mx-auto px-4 py-16">
          <div className="bg-gradient-to-r from-blue-400/20 to-blue-300/10 rounded-xl p-8 md:p-12 text-center">
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 tracking-tight">
              Ready to grow your online presence?
            </h2>
            <p className="text-light-100/70 mb-8 max-w-2xl mx-auto">
              Let's work together to create content that engages your audience, ranks well in search engines, and converts visitors into customers.
            </p>
            <Button size="lg" className="bg-blue-300 hover:bg-blue-400 text-dark-100">
              Get in Touch
            </Button>
          </div>
        </section>
      </div>
    </Layout>
  );
};

export default About;
