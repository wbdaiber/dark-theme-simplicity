var ContactPageWP = (function(React, ReactDOM) {
  function ContactPageWP() {
    const _useState = React.useState;
    const _useEffect = React.useEffect;
    const _useState2 = _useState("");
    const _useState3 = _useState("");
    const useState = React.useState;
    const useEffect = React.useEffect;
    const useForm = ReactHookForm.useForm;
    const zodResolver = ZodResolver.zodResolver;

    const [isSubmitting, setIsSubmitting] = _useState(false);
    const [wpNonce, setWpNonce] = _useState("");

    useEffect(function() {
      const wpApiSettings = window.wpApiSettings;
      if (wpApiSettings && wpApiSettings.nonce) {
        setWpNonce(wpApiSettings.nonce);
      }
    }, []);

    const formSchema = z.object({
      name: z.string().min(2, { message: "Name must be at least 2 characters." }),
      email: z.string().email({ message: "Please enter a valid email address." }),
      subject: z.string().min(5, { message: "Subject must be at least 5 characters." }),
      message: z.string().min(10, { message: "Message must be at least 10 characters." })
    });

    const form = useForm({
      resolver: zodResolver(formSchema),
      defaultValues: {
        name: "",
        email: "",
        subject: "",
        message: ""
      }
    });

    function onSubmit(values) {
      setIsSubmitting(true);
      fetch("/wp-json/contact-form/v1/submit", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": wpNonce
        },
        body: JSON.stringify(values)
      }).then(function(response) {
        return response.json();
      }).then(function(data) {
        setIsSubmitting(false);
        toast.success("Message sent successfully! We'll get back to you soon.");
        form.reset();
      }).catch(function(error) {
        setIsSubmitting(false);
        toast.error("Failed to send message. Please try again.");
      });
    }

    return React.createElement(
      "div",
      { className: "py-24 px-4 sm:px-6 lg:px-8 bg-dark-200" },
      React.createElement(
        "div",
        { className: "container mx-auto max-w-5xl" },
        React.createElement(
          "div",
          { className: "text-center mb-16 animate-fade-in" },
          React.createElement(
            Badge,
            { variant: "outline", className: "mb-3 py-1.5 px-4 bg-blue-300/10 text-blue-300 border-blue-300/20" },
            "Get in Touch"
          ),
          React.createElement(
            "h1",
            { className: "text-4xl md:text-5xl font-display font-bold mb-6 text-light-100" },
            "Contact Me"
          ),
          React.createElement(
            "p",
            { className: "text-xl text-light-100/70 max-w-2xl mx-auto" },
            "Have a question or want to work together? Fill out the form below and I'll get back to you as soon as possible."
          )
        ),
        React.createElement(
          "div",
          { className: "grid grid-cols-1 md:grid-cols-3 gap-10" },
          React.createElement(
            "div",
            { className: "space-y-8 md:space-y-10" },
            React.createElement(
              "div",
              { className: "glass-card p-6 rounded-xl animate-fade-in" },
              React.createElement(
                "div",
                { className: "flex items-start space-x-4" },
                React.createElement(
                  "div",
                  { className: "bg-blue-300/20 p-3 rounded-lg" },
                  React.createElement(Mail, { className: "h-6 w-6 text-blue-300" })
                ),
                React.createElement(
                  "div",
                  null,
                  React.createElement(
                    "h3",
                    { className: "text-lg font-medium mb-1" },
                    "Email"
                  ),
                  React.createElement(
                    "p",
                    { className: "text-light-100/70" },
                    "hello@braddaiber.com"
                  )
                )
              )
            ),
            React.createElement(
              "div",
              { className: "glass-card p-6 rounded-xl animate-fade-in animation-delay-200" },
              React.createElement(
                "div",
                { className: "flex items-start space-x-4" },
                React.createElement(
                  "div",
                  { className: "bg-blue-300/20 p-3 rounded-lg" },
                  React.createElement(Phone, { className: "h-6 w-6 text-blue-300" })
                ),
                React.createElement(
                  "div",
                  null,
                  React.createElement(
                    "h3",
                    { className: "text-lg font-medium mb-1" },
                    "Phone"
                  ),
                  React.createElement(
                    "p",
                    { className: "text-light-100/70" },
                    "(555) 123-4567"
                  )
                )
              )
            ),
            React.createElement(
              "div",
              { className: "glass-card p-6 rounded-xl animate-fade-in animation-delay-400" },
              React.createElement(
                "div",
                { className: "flex items-start space-x-4" },
                React.createElement(
                  "div",
                  { className: "bg-blue-300/20 p-3 rounded-lg" },
                  React.createElement(MapPin, { className: "h-6 w-6 text-blue-300" })
                ),
                React.createElement(
                  "div",
                  null,
                  React.createElement(
                    "h3",
                    { className: "text-lg font-medium mb-1" },
                    "Location"
                  ),
                  React.createElement(
                    "p",
                    { className: "text-light-100/70" },
                    "New York, NY"
                  )
                )
              )
            )
          ),
          React.createElement(
            "div",
            { className: "col-span-1 md:col-span-2 animate-fade-in animation-delay-200" },
            React.createElement(
              "div",
              { className: "glass-card p-8 rounded-xl" },
              React.createElement(
                Form,
                { ...form },
                React.createElement(
                  "form",
                  { onSubmit: form.handleSubmit(onSubmit), className: "space-y-6" },
                  React.createElement(
                    "div",
                    { className: "grid grid-cols-1 sm:grid-cols-2 gap-6" },
                    React.createElement(FormField, {
                      control: form.control,
                      name: "name",
                      render: function render(_ref) {
                        var field = _ref.field;
                        return React.createElement(
                          FormItem,
                          null,
                          React.createElement(
                            FormLabel,
                            null,
                            "Name"
                          ),
                          React.createElement(
                            FormControl,
                            null,
                            React.createElement(Input, { placeholder: "Your name", ...field })
                          ),
                          React.createElement(FormMessage, null)
                        );
                      }
                    }),
                    React.createElement(FormField, {
                      control: form.control,
                      name: "email",
                      render: function render(_ref2) {
                        var field = _ref2.field;
                        return React.createElement(
                          FormItem,
                          null,
                          React.createElement(
                            FormLabel,
                            null,
                            "Email"
                          ),
                          React.createElement(
                            FormControl,
                            null,
                            React.createElement(Input, { placeholder: "Your email", ...field })
                          ),
                          React.createElement(FormMessage, null)
                        );
                      }
                    })
                  ),
                  React.createElement(FormField, {
                    control: form.control,
                    name: "subject",
                    render: function render(_ref3) {
                      var field = _ref3.field;
                      return React.createElement(
                        FormItem,
                        null,
                        React.createElement(
                          FormLabel,
                          null,
                          "Subject"
                        ),
                        React.createElement(
                          FormControl,
                          null,
                          React.createElement(Input, { placeholder: "Subject of your message", ...field })
                        ),
                        React.createElement(FormMessage, null)
                      );
                    }
                  }),
                  React.createElement(FormField, {
                    control: form.control,
                    name: "message",
                    render: function render(_ref4) {
                      var field = _ref4.field;
                      return React.createElement(
                        FormItem,
                        null,
                        React.createElement(
                          FormLabel,
                          null,
                          "Message"
                        ),
                        React.createElement(
                          FormControl,
                          null,
                          React.createElement(Textarea, {
                            placeholder: "Your message",
                            className: "min-h-[150px]",
                            ...field
                          })
                        ),
                        React.createElement(FormMessage, null)
                      );
                    }
                  }),
                  React.createElement(
                    Button,
                    {
                      type: "submit",
                      disabled: isSubmitting,
                      className: "w-full sm:w-auto"
                    },
                    isSubmitting ? React.createElement(
                      "span",
                      { className: "flex items-center" },
                      React.createElement(
                        "svg",
                        { className: "animate-spin -ml-1 mr-2 h-4 w-4 text-white", xmlns: "http://www.w3.org/2000/svg", fill: "none", viewBox: "0 0 24 24" },
                        React.createElement("circle", { className: "opacity-25", cx: "12", cy: "12", r: "10", stroke: "currentColor", strokeWidth: "4" }),
                        React.createElement("path", { className: "opacity-75", fill: "currentColor", d: "M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" })
                      ),
                      "Sending..."
                    ) : React.createElement(
                      "span",
                      { className: "flex items-center" },
                      React.createElement(Send, { className: "mr-2 h-4 w-4" }),
                      "Send Message"
                    )
                  )
                )
              )
            )
          )
        ),
        React.createElement(
          "div",
          { className: "mt-24" },
          React.createElement(
            "div",
            { className: "text-center mb-12 animate-fade-in" },
            React.createElement(
              "h2",
              { className: "text-3xl md:text-4xl font-display font-bold mb-4" },
              "Frequently Asked Questions"
            ),
            React.createElement(
              "p",
              { className: "text-xl text-light-100/70 max-w-2xl mx-auto" },
              "Here are answers to some common questions I receive."
            )
          ),
          React.createElement(
            "div",
            { className: "grid grid-cols-1 md:grid-cols-2 gap-6" },
            [
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
            ].map(function (faq, index) {
              return React.createElement(
                "div",
                {
                  key: index,
                  className: "glass-card p-6 rounded-xl animate-fade-in",
                  style: { animationDelay: (index + 1) * 100 + "ms" }
                },
                React.createElement(
                  "h3",
                  { className: "text-xl font-medium mb-3 text-blue-300" },
                  faq.question
                ),
                React.createElement(
                  "p",
                  { className: "text-light-100/70" },
                  faq.answer
                )
              );
            })
          )
        )
      )
    );
  }

  return ContactPageWP;
})(React, ReactDOM);
