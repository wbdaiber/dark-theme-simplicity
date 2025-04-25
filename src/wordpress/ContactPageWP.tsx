
import { useState, useEffect } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Textarea } from '@/components/ui/textarea';
import { Badge } from '@/components/ui/badge';
import { 
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage
} from '@/components/ui/form';
import { useForm } from 'react-hook-form';
import { zodResolver } from '@hookform/resolvers/zod';
import * as z from 'zod';
import { Mail, Phone, MapPin, Send } from 'lucide-react';
import { toast } from 'sonner';

const formSchema = z.object({
  name: z.string().min(2, {
    message: "Name must be at least 2 characters.",
  }),
  email: z.string().email({
    message: "Please enter a valid email address.",
  }),
  subject: z.string().min(5, {
    message: "Subject must be at least 5 characters.",
  }),
  message: z.string().min(10, {
    message: "Message must be at least 10 characters.",
  }),
});

const ContactPageWP = () => {
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [wpNonce, setWpNonce] = useState('');
  
  useEffect(() => {
    // Check if wp_localize_script was used to pass the nonce
    const wpApiSettings = (window as any).wpApiSettings;
    if (wpApiSettings && wpApiSettings.nonce) {
      setWpNonce(wpApiSettings.nonce);
    }
  }, []);

  const form = useForm<z.infer<typeof formSchema>>({
    resolver: zodResolver(formSchema),
    defaultValues: {
      name: "",
      email: "",
      subject: "",
      message: "",
    },
  });

  function onSubmit(values: z.infer<typeof formSchema>) {
    setIsSubmitting(true);
    
    fetch('/wp-json/contact-form/v1/submit', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': wpNonce
      },
      body: JSON.stringify(values),
    })
      .then(response => response.json())
      .then(data => {
        setIsSubmitting(false);
        toast.success("Message sent successfully! We'll get back to you soon.");
        form.reset();
      })
      .catch(error => {
        setIsSubmitting(false);
        toast.error("Failed to send message. Please try again.");
      });
  }

  return (
    <div className="py-24 px-4 sm:px-6 lg:px-8 bg-dark-200">
      <div className="container mx-auto max-w-5xl">
        <div className="text-center mb-16 animate-fade-in">
          <Badge variant="outline" className="mb-3 py-1.5 px-4 bg-blue-300/10 text-blue-300 border-blue-300/20">
            Get in Touch
          </Badge>
          <h1 className="text-4xl md:text-5xl font-display font-bold mb-6 text-light-100">
            Contact Me
          </h1>
          <p className="text-xl text-light-100/70 max-w-2xl mx-auto">
            Have a question or want to work together? Fill out the form below 
            and I'll get back to you as soon as possible.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-10">
          <div className="space-y-8 md:space-y-10">
            <div className="glass-card p-6 rounded-xl animate-fade-in">
              <div className="flex items-start space-x-4">
                <div className="bg-blue-300/20 p-3 rounded-lg">
                  <Mail className="h-6 w-6 text-blue-300" />
                </div>
                <div>
                  <h3 className="text-lg font-medium mb-1">Email</h3>
                  <p className="text-light-100/70">hello@braddaiber.com</p>
                </div>
              </div>
            </div>
            
            <div className="glass-card p-6 rounded-xl animate-fade-in animation-delay-200">
              <div className="flex items-start space-x-4">
                <div className="bg-blue-300/20 p-3 rounded-lg">
                  <Phone className="h-6 w-6 text-blue-300" />
                </div>
                <div>
                  <h3 className="text-lg font-medium mb-1">Phone</h3>
                  <p className="text-light-100/70">(555) 123-4567</p>
                </div>
              </div>
            </div>
            
            <div className="glass-card p-6 rounded-xl animate-fade-in animation-delay-400">
              <div className="flex items-start space-x-4">
                <div className="bg-blue-300/20 p-3 rounded-lg">
                  <MapPin className="h-6 w-6 text-blue-300" />
                </div>
                <div>
                  <h3 className="text-lg font-medium mb-1">Location</h3>
                  <p className="text-light-100/70">New York, NY</p>
                </div>
              </div>
            </div>
          </div>
          
          <div className="col-span-1 md:col-span-2 animate-fade-in animation-delay-200">
            <div className="glass-card p-8 rounded-xl">
              <Form {...form}>
                <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
                  <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <FormField
                      control={form.control}
                      name="name"
                      render={({ field }) => (
                        <FormItem>
                          <FormLabel>Name</FormLabel>
                          <FormControl>
                            <Input placeholder="Your name" {...field} />
                          </FormControl>
                          <FormMessage />
                        </FormItem>
                      )}
                    />
                    
                    <FormField
                      control={form.control}
                      name="email"
                      render={({ field }) => (
                        <FormItem>
                          <FormLabel>Email</FormLabel>
                          <FormControl>
                            <Input placeholder="Your email" {...field} />
                          </FormControl>
                          <FormMessage />
                        </FormItem>
                      )}
                    />
                  </div>
                  
                  <FormField
                    control={form.control}
                    name="subject"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Subject</FormLabel>
                        <FormControl>
                          <Input placeholder="Subject of your message" {...field} />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                  
                  <FormField
                    control={form.control}
                    name="message"
                    render={({ field }) => (
                      <FormItem>
                        <FormLabel>Message</FormLabel>
                        <FormControl>
                          <Textarea 
                            placeholder="Your message" 
                            className="min-h-[150px]" 
                            {...field} 
                          />
                        </FormControl>
                        <FormMessage />
                      </FormItem>
                    )}
                  />
                  
                  <Button 
                    type="submit" 
                    disabled={isSubmitting}
                    className="w-full sm:w-auto"
                  >
                    {isSubmitting ? (
                      <span className="flex items-center">
                        <svg className="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                          <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending...
                      </span>
                    ) : (
                      <span className="flex items-center">
                        <Send className="mr-2 h-4 w-4" />
                        Send Message
                      </span>
                    )}
                  </Button>
                </form>
              </Form>
            </div>
          </div>
        </div>
        
        <div className="mt-24">
          <div className="text-center mb-12 animate-fade-in">
            <h2 className="text-3xl md:text-4xl font-display font-bold mb-4">
              Frequently Asked Questions
            </h2>
            <p className="text-xl text-light-100/70 max-w-2xl mx-auto">
              Here are answers to some common questions I receive.
            </p>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            {[
              {
                question: "What services do you offer?",
                answer: "I specialize in SEO consulting, copywriting, and web design services to help businesses grow their online presence."
              },
              {
                question: "How long does a typical project take?",
                answer: "Project timelines vary based on scope and complexity. A typical website takes 2-4 weeks, while SEO campaigns are ongoing with initial results in 1-3 months."
              },
              {
                question: "What are your rates?",
                answer: "I offer custom pricing based on your specific needs and project requirements. Contact me for a personalized quote."
              },
              {
                question: "Do you work with clients remotely?",
                answer: "Yes, I work with clients from anywhere in the world. All meetings can be conducted via video call or phone."
              }
            ].map((faq, index) => (
              <div 
                key={index} 
                className="glass-card p-6 rounded-xl animate-fade-in"
                style={{ animationDelay: `${(index + 1) * 100}ms` }}
              >
                <h3 className="text-xl font-medium mb-3 text-blue-300">{faq.question}</h3>
                <p className="text-light-100/70">{faq.answer}</p>
              </div>
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default ContactPageWP;
