
import { motion } from "framer-motion";
import { Book, Award, Clock, Users, ArrowRight } from "lucide-react";
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
              About Us
            </Badge>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-display font-bold mb-6 tracking-tight">
              We help <span className="text-blue-300">businesses grow</span> through strategic content
            </h1>
            <p className="text-lg md:text-xl text-light-100/70 mb-8 max-w-2xl mx-auto">
              Our team of experts is dedicated to helping businesses improve their online presence
              and reach their target audience through strategic content marketing.
            </p>
          </div>
        </section>
        
        {/* Mission & Values */}
        <section className="container mx-auto px-4 py-16">
          <div className="grid md:grid-cols-2 gap-12 items-center">
            <div>
              <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
                Our Mission
              </Badge>
              <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 tracking-tight">
                Empower businesses to thrive online
              </h2>
              <p className="text-light-100/70 mb-6">
                We believe that great content is the foundation of a successful online presence. Our mission is to help businesses create content that engages their audience, ranks well in search engines, and converts visitors into customers.
              </p>
              <div className="space-y-4">
                {[
                  "Strategic content planning that aligns with business goals",
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
                  src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" 
                  alt="Team working together" 
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
                { number: "200+", label: "Clients", icon: Users },
                { number: "1200+", label: "Articles", icon: Book },
                { number: "15+", label: "Awards", icon: Award },
                { number: "24/7", label: "Support", icon: Clock },
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
        
        {/* Team */}
        <section className="container mx-auto px-4 py-16">
          <div className="text-center mb-12">
            <Badge variant="outline" className="mb-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
              Our Team
            </Badge>
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-6 tracking-tight">
              Meet the experts behind our success
            </h2>
            <p className="text-light-100/70 max-w-2xl mx-auto">
              Our talented team of content strategists, SEO specialists, and writers are dedicated to helping your business grow through strategic content marketing.
            </p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-8">
            {[
              {
                name: "Brad Daiber",
                role: "Founder & CEO",
                image: "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80",
                bio: "10+ years of experience in content marketing and SEO. Passionate about helping businesses grow online."
              },
              {
                name: "Sarah Johnson",
                role: "Content Strategist",
                image: "https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80",
                bio: "SEO expert with a background in journalism. Specializes in creating content strategies that drive results."
              },
              {
                name: "Michael Chen",
                role: "Lead Developer",
                image: "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=774&q=80",
                bio: "Full-stack developer with expertise in creating seamless digital experiences that convert."
              }
            ].map((member, index) => (
              <Card key={index} className="bg-dark-100/50 border-0 overflow-hidden hover:transform hover:scale-[1.02] transition-all duration-300">
                <div className="h-64 overflow-hidden">
                  <img 
                    src={member.image} 
                    alt={member.name} 
                    className="w-full h-full object-cover"
                  />
                </div>
                <CardContent className="p-6">
                  <h3 className="text-xl font-bold mb-1">{member.name}</h3>
                  <p className="text-blue-300 mb-3">{member.role}</p>
                  <p className="text-light-100/70">{member.bio}</p>
                </CardContent>
              </Card>
            ))}
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
